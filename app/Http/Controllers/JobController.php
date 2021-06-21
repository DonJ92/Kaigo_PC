<?php

namespace App\Http\Controllers;


use App\Job;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    public function search()
    {
        return view('jobsearch');
    }

    public function detail()
    {
        return view('jobdetail');
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

        if (Auth::check())
            $user_id = Auth::user()->id;
        else
            $user_id = 0;

        $job_list = array();
        try {
            $query = Job::leftjoin('tbl_user', 'tbl_user.id', '=', 'tbl_job.user_id')
                ->leftjoin('tbl_profile', 'tbl_profile.user_id', '=', 'tbl_job.user_id')
                ->leftjoin('tbl_province', 'tbl_province.id', '=', 'tbl_job.province')
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
            $data['photo'] = $this->getProfilePhoto($data);
            $data['cost'] = '¥'.number_format($data['cost'], 0, '.', ',').' / 1h';
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