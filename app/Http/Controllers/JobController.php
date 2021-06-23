<?php

namespace App\Http\Controllers;


use App\Job;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    public function search()
    {
        $data['province_list'] = $this->getProvinceList();
        $data['job_list'] = $this->getJobTypeList();
        $data['age_list'] = Config::get('constants.age');

        return view('jobsearch', $data);
    }

    public function detail($id)
    {
        try {
            $job_info = Job::leftjoin('tbl_user', 'tbl_user.id', '=', 'tbl_job.user_id')
                ->leftjoin('tbl_profile', 'tbl_profile.user_id', '=', 'tbl_job.user_id')
                ->leftjoin('tbl_province', 'tbl_province.id', '=', 'tbl_job.province')
                ->leftjoin('tbl_job_type', 'tbl_job_type.id', '=', 'tbl_job.type')
                ->leftjoin('tbl_favourite', function ($join)
                {
                    $join->on('tbl_job.id', '=', 'tbl_favourite.target_id');
                })
                ->leftjoin(DB::raw('(SELECT target_id, count( user_id ) AS favourite_count FROM tbl_favourite where type = '.FAVOURITE_JOB.' GROUP BY target_id) tbl_following'),function($join)
                {
                    $join->on('tbl_job.id', '=', 'tbl_following.target_id');
                })
                ->select('tbl_job.*', 'tbl_user.last_name', 'tbl_user.first_name', 'tbl_province.name as province_name',
                    'tbl_profile.photo1', 'tbl_profile.photo2', 'tbl_profile.photo3', 'tbl_profile.photo4', 'tbl_profile.photo5',
                    'tbl_job_type.job_type', 'tbl_following.favourite_count')
                ->where('tbl_job.id', $id)
                ->first();

            if (is_null($job_info))
                return redirect()->back()->withErrors(['failed' => trans('job.no_info')]);

            $data = $job_info->toArray();

            $current_year = Date('Y');
            $data['period'] = str_replace($current_year.'/', '', $data['period']);
            $data['cost'] = '¥'.number_format($data['cost'], 0, '.', ',').' / 1h';

            $user_info = $data;
            $user_info['id'] = $user_info['user_id'];
            $data['photo'] = $this->getProfilePhoto($user_info);

            $cert_id_list = explode(',', $data['certificate']);
            $certificates = $this->getCertificateFromIDs($cert_id_list);
            $data['certificate'] = implode(', ', $certificates);

            $data['accident'] = $this->getAccidentTypeFromID($data['accident']);
            $data['traffic_cost'] = $this->getTrafficCostTypeFromID($data['traffic_cost']);
            $data['payment_method'] = $this->getPaymentMethodTypeFromID($data['payment_method']);
            $data['coupon'] = $this->getCouponTypeFromID($data['coupon']);
        } catch (QueryException $e) {
            return redirect()->back()->withErrors(['failed' => trans('job.no_info')]);
        }

        return view('jobdetail', $data);
    }

    public function dashboardSearch()
    {
        $this->middleware('auth');
        return view('dashboard.jobsearch');
    }

    public function getlist(Request $request)
    {
        $count = $request->input('count');
        $index = $request->input('index');
        $province = $request->input('province');
        $from_time = $request->input('from_time');
        $to_time = $request->input('to_time');
        $job_type = $request->input('job_type');
        $status = $request->input('status');
        $age = $request->input('age');
        $period = $request->input('period');

        if (Auth::check())
            $user_id = Auth::user()->id;
        else
            $user_id = 0;

        $job_list = array();
        try {
            $query = Job::leftjoin('tbl_user', 'tbl_user.id', '=', 'tbl_job.user_id')
                ->leftjoin('tbl_profile', 'tbl_profile.user_id', '=', 'tbl_job.user_id')
                ->leftjoin('tbl_province', 'tbl_province.id', '=', 'tbl_job.province')
                ->leftjoin('tbl_job_type', 'tbl_job_type.id', '=', 'tbl_job.type')
                ->leftjoin('tbl_favourite', function($join) use($user_id)
                {
                    $join->on('tbl_job.id', '=', 'tbl_favourite.target_id');
                    $join->where('tbl_favourite.user_id', '=', $user_id);
                })
                ->leftjoin(DB::raw('(SELECT target_id, count( user_id ) AS favourite_count FROM tbl_favourite where type = '.FAVOURITE_JOB.' GROUP BY target_id) tbl_following'),function($join)
                {
                    $join->on('tbl_job.id', '=', 'tbl_following.target_id');
                })
                ->select('tbl_job.id', 'tbl_job.user_id', 'tbl_user.last_name', 'tbl_user.first_name', 'tbl_job.title', 'tbl_province.name as province', 'tbl_job.address',
                    'tbl_profile.photo1', 'tbl_profile.photo2', 'tbl_profile.photo3', 'tbl_profile.photo4', 'tbl_profile.photo5',
                    'tbl_job.period', 'tbl_job.from_time', 'tbl_job.to_time', 'tbl_job.cost', 'tbl_favourite.id as favourite_id',
                    'tbl_following.favourite_count')
                ->orderby('tbl_following.favourite_count', 'desc')
                ->skip($count)->take(JOB_LIST_PAGE_CNT);

            if (!is_null($index) && !empty($index)){
                $query = $query->where(function($q) use ($index){
                    $q->where('tbl_job.title', 'LIKE', '%'.$index.'%')
                        ->orWhere('tbl_province.name', 'LIKE', '%'.$index.'%')
                        ->orWhere('tbl_job_type.job_type', 'LIKE', '%'.$index.'%');
                });
            }
            if (!is_null($province) && !empty($province))
                $query = $query->whereIn('tbl_job.province', $province);
            if (!is_null($job_type) && !empty($job_type))
                $query = $query->where('tbl_job.type', $job_type);
            if (!is_null($from_time) && !empty($from_time))
                $query = $query->where('tbl_job.from_time', '>=', $from_time);
            if (!is_null($to_time) && !empty($to_time))
                $query = $query->where('tbl_job.to_time', '<=', $to_time);
            if (!is_null($age) && !empty($age))
                $query = $query->where('tbl_profile.age', $age);
            if ($status == true)
                $query = $query->where('tbl_job.status', JOB_RECRUITING);
            if (!is_null($period) && !empty($period)) {
                $period = implode(',', $period);
                $query = $query->where('tbl_job.period', 'LIKE', '%'.$period.'%');
            }

            $job_list = $query->get()->toArray();

            $current_year = Date('Y');
            for ($i = 0; $i < count($job_list); $i++) {
                $job_list[$i]['period'] = str_replace($current_year.'/', '', $job_list[$i]['period']);
                $user_info = $job_list[$i];
                $user_info['id'] = $user_info['user_id'];
                $job_list[$i]['photo'] = $this->getProfilePhoto($user_info);
                $job_list[$i]['cost'] = '¥'.number_format($job_list[$i]['cost'], 0, '.', ',').' / 1h';
                $job_list[$i]['from_time'] = date('G:i', strtotime($job_list[$i]['from_time']));
                $job_list[$i]['to_time'] = date('G:i', strtotime($job_list[$i]['to_time']));
            }
        } catch (QueryException $e) {
            echo json_encode( $job_list );
            exit;
        }

        echo json_encode( $job_list );
    }

    public function dashboardDetail($id)
    {
        $this->middleware('auth');

        try {
            $job_info = Job::leftjoin('tbl_user', 'tbl_user.id', '=', 'tbl_job.user_id')
                ->leftjoin('tbl_profile', 'tbl_profile.user_id', '=', 'tbl_job.user_id')
                ->leftjoin('tbl_province', 'tbl_province.id', '=', 'tbl_job.province')
                ->leftjoin('tbl_job_type', 'tbl_job_type.id', '=', 'tbl_job.type')
                ->leftjoin('tbl_favourite', function ($join)
                {
                    $join->on('tbl_job.id', '=', 'tbl_favourite.target_id');
                    $join->where('tbl_favourite.user_id', '=', Auth::user()->id);
                })
                ->leftjoin(DB::raw('(SELECT target_id, count( user_id ) AS favourite_count FROM tbl_favourite where type = '.FAVOURITE_JOB.' GROUP BY target_id) tbl_following'),function($join)
                {
                    $join->on('tbl_job.id', '=', 'tbl_following.target_id');
                })
                ->select('tbl_job.*', 'tbl_user.last_name', 'tbl_user.first_name', 'tbl_province.name as province_name',
                    'tbl_profile.photo1', 'tbl_profile.photo2', 'tbl_profile.photo3', 'tbl_profile.photo4', 'tbl_profile.photo5',
                    'tbl_job_type.job_type', 'tbl_following.favourite_count')
                ->where('tbl_job.id', $id)
                ->first();

            if (is_null($job_info))
                return redirect()->back()->withErrors(['failed' => trans('job.no_info')]);

            $data = $job_info->toArray();

            $current_year = Date('Y');
            $data['period'] = str_replace($current_year.'/', '', $data['period']);
            $data['cost'] = '¥'.number_format($data['cost'], 0, '.', ',').' / 1h';

            $user_info = $data;
            $user_info['id'] = $user_info['user_id'];
            $data['photo'] = $this->getProfilePhoto($user_info);

            $cert_id_list = explode(',', $data['certificate']);
            $certificates = $this->getCertificateFromIDs($cert_id_list);
            $data['certificate'] = implode(', ', $certificates);

            $data['accident'] = $this->getAccidentTypeFromID($data['accident']);
            $data['traffic_cost'] = $this->getTrafficCostTypeFromID($data['traffic_cost']);
            $data['payment_method'] = $this->getPaymentMethodTypeFromID($data['payment_method']);
            $data['coupon'] = $this->getCouponTypeFromID($data['coupon']);
        } catch (QueryException $e) {
            return redirect()->back()->withErrors(['failed' => trans('job.no_info')]);
        }
        return view('dashboard.jobdetail', $data);
    }
}