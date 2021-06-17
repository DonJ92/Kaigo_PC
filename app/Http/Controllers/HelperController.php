<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class HelperController extends Controller
{
    public function search()
    {
        $data['province_list'] = $this->getProvinceList();
        $data['job_list'] = $this->getJobTypeList();
        $data['experience_list'] = Config::get('constants.experience');
        $data['age_list'] = Config::get('constants.age');

        return view('helpersearch', $data);
    }

    public function detail($id)
    {
        try {
            $helper_info = User::leftjoin('tbl_profile', 'tbl_profile.user_id', '=', 'tbl_user.id')
                ->leftjoin('tbl_province', 'tbl_province.id', '=', 'tbl_user.province_id')
                ->leftjoin(DB::raw('(SELECT target_id, count( user_id ) AS favourite_count FROM tbl_favourite GROUP BY target_id) tbl_following'),function($join)
                {
                    $join->on('tbl_user.id', '=', 'tbl_following.target_id');
                })
                ->where('tbl_user.id', $id)
                ->select('tbl_user.id', 'tbl_user.last_name', 'tbl_user.first_name', 'tbl_user.gender', 'tbl_province.name as province_name', 'tbl_user.address',
                    'tbl_profile.introduction', 'tbl_profile.photo1', 'tbl_profile.photo2', 'tbl_profile.photo3', 'tbl_profile.photo4', 'tbl_profile.photo5',
                    'tbl_profile.age', 'tbl_profile.experience_years', 'tbl_profile.job_type', 'tbl_profile.certificate', 'tbl_profile.hourly_cost_from', 'tbl_profile.hourly_cost_to',
                    'tbl_following.favourite_count')
                ->first();

            if (is_null($helper_info))
                return redirect()->back()->withErrors(['failed' => trans('helper.no_info')]);

            $data = $helper_info->toArray();

            $data['photo1'] = $this->getProfilePhotoThumb($data['id'], $data['photo1']);
            $data['photo2'] = $this->getProfilePhotoThumb($data['id'], $data['photo2']);
            $data['photo3'] = $this->getProfilePhotoThumb($data['id'], $data['photo3']);
            $data['photo4'] = $this->getProfilePhotoThumb($data['id'], $data['photo4']);
            $data['photo5'] = $this->getProfilePhotoThumb($data['id'], $data['photo5']);
            $data['gender'] = $this->getGenderFromID($data['gender']);
            $data['age'] = $this->getAgeFromID($data['age']);
            $data['job_type'] = $this->getJobFromID($data['job_type']);
            $data['experience_years'] = $this->getExperienceYearsFromID($data['experience_years']);
            $cert_id_list = explode(',', $data['certificate']);
            $certificates = $this->getCertificateFromIDs($cert_id_list);
            $data['certificate'] = implode(', ', $certificates);
            $data['hourly_cost'] = '￥' . number_format($data['hourly_cost_from'], 0, '.', ',') . ' ~ ' . '￥' . number_format($data['hourly_cost_to'], 0, '.', ',');

        } catch (QueryException $e) {
            return redirect()->back()->withErrors(['failed' => trans('helper.no_info')]);
        }

        return view('helperdetail', $data);
    }

    public function dashboardSearch()
    {
        $this->middleware('auth');

        $data['province_list'] = $this->getProvinceList();
        $data['job_list'] = $this->getJobTypeList();
        $data['experience_list'] = Config::get('constants.experience');
        $data['age_list'] = Config::get('constants.age');

        return view('dashboard.helpersearch', $data);
    }

    public function getList(Request $request)
    {
        $count = $request->input('count');
        $index = $request->input('index');
        $province = $request->input('province');
        $job_type = $request->input('job_type');
        $experience_years = $request->input('experience_years');
        $age = $request->input('age');

        if (Auth::check())
            $user_id = Auth::user()->id;
        else
            $user_id = 0;

        $helper_list = array();
        try {
            $query = User::leftjoin('tbl_profile', 'tbl_profile.user_id', '=', 'tbl_user.id')
                ->leftjoin('tbl_province', 'tbl_province.id', '=', 'tbl_user.province_id')
                ->leftjoin('tbl_favourite', function($join) use($user_id)
                {
                    $join->on('tbl_user.id', '=', 'tbl_favourite.target_id');
                    $join->where('tbl_favourite.user_id', '=', $user_id);
                })
                ->leftjoin(DB::raw('(SELECT target_id, count( user_id ) AS favourite_count FROM tbl_favourite GROUP BY target_id) tbl_following'),function($join)
                {
                    $join->on('tbl_user.id', '=', 'tbl_following.target_id');
                })
                ->leftjoin('tbl_job_type', 'tbl_job_type.id', '=', 'tbl_profile.job_type')
                ->where('tbl_user.type', HELPER)
                ->select('tbl_user.id', 'tbl_user.last_name', 'tbl_user.first_name', 'tbl_user.gender',
                    'tbl_province.name as province_name', 'tbl_user.address', 'tbl_profile.photo1', 'tbl_profile.photo2',
                    'tbl_profile.photo3', 'tbl_profile.photo4', 'tbl_profile.photo5', 'tbl_profile.age', 'tbl_profile.certificate',
                    'tbl_profile.hourly_cost_from', 'tbl_profile.hourly_cost_to', 'tbl_favourite.id as favourite_id',
                    'tbl_following.favourite_count')
                ->orderby('tbl_following.favourite_count', 'desc')
                ->skip($count)->take(HELPER_LIST_PAGE_CNT);

            if (!is_null($index) && !empty($index)){
                $query = $query->where(function($q) use ($index){
                    $q->where(DB::raw("CONCAT(tbl_user.last_name,'',tbl_user.first_name)"), 'LIKE', '%'.$index.'%')
                        ->orWhere('tbl_province.name', 'LIKE', '%'.$index.'%')
                        ->orWhere('tbl_job_type.job_type', 'LIKE', '%'.$index.'%');
                });
            }
            if (!is_null($province) && !empty($province))
                $query = $query->whereIn('tbl_user.province_id', $province);
            if (!is_null($job_type) && !empty($job_type))
                $query = $query->where('tbl_profile.job_type', $job_type);
            if (!is_null($experience_years) && !empty($experience_years))
                $query = $query->where('tbl_profile.experience_years', $experience_years);
            if (!is_null($age) && !empty($age))
                $query = $query->where('tbl_profile.age', $age);

            $helper_list = $query->get()->toArray();

            for ($i = 0; $i < count($helper_list); $i++) {
                $helper_list[$i]['photo'] = $this->getProfilePhoto($helper_list[$i]);
                $helper_list[$i]['gender'] = $this->getGenderFromID($helper_list[$i]['gender']);
                $helper_list[$i]['age'] = $this->getAgeFromID($helper_list[$i]['age']);

                $cert_id_list = explode(',', $helper_list[$i]['certificate']);
                $certificates = $this->getCertificateFromIDs($cert_id_list);
                $helper_list[$i]['certificate'] = implode(', ', $certificates);
                $helper_list[$i]['hourly_cost'] = '￥' . number_format($helper_list[$i]['hourly_cost_from'], 0, '.', ',') . ' ~ ' . '￥' . number_format($helper_list[$i]['hourly_cost_to'], 0, '.', ',');
            }
        } catch (QueryException $e) {
            print_r($e->getMessage());
            die();
            echo json_encode( $helper_list );
            exit;
        }

        echo json_encode($helper_list);
    }

    public function dashboardDetail($id)
    {
        $this->middleware('auth');

        try {
            $helper_info = User::leftjoin('tbl_profile', 'tbl_profile.user_id', '=', 'tbl_user.id')
                ->leftjoin('tbl_province', 'tbl_province.id', '=', 'tbl_user.province_id')
                ->leftjoin('tbl_favourite', function ($join)
                {
                    $join->on('tbl_user.id', '=', 'tbl_favourite.target_id');
                    $join->where('tbl_favourite.user_id', '=', Auth::user()->id);
                })
                ->leftjoin(DB::raw('(SELECT target_id, count( user_id ) AS favourite_count FROM tbl_favourite GROUP BY target_id) tbl_following'),function($join)
                {
                    $join->on('tbl_user.id', '=', 'tbl_following.target_id');
                })
                ->where('tbl_user.id', $id)
                ->select('tbl_user.id', 'tbl_user.last_name', 'tbl_user.first_name', 'tbl_user.gender', 'tbl_province.name as province_name', 'tbl_user.address',
                    'tbl_profile.introduction', 'tbl_profile.photo1', 'tbl_profile.photo2', 'tbl_profile.photo3', 'tbl_profile.photo4', 'tbl_profile.photo5',
                    'tbl_profile.age', 'tbl_profile.experience_years', 'tbl_profile.job_type', 'tbl_profile.certificate', 'tbl_profile.hourly_cost_from', 'tbl_profile.hourly_cost_to',
                    'tbl_following.favourite_count', 'tbl_favourite.id as favourite_id')
                ->first();

            if (is_null($helper_info))
                return redirect()->back()->withErrors(['failed' => trans('helper.no_info')]);

            $data = $helper_info->toArray();

            $data['photo1'] = $this->getProfilePhotoThumb($data['id'], $data['photo1']);
            $data['photo2'] = $this->getProfilePhotoThumb($data['id'], $data['photo2']);
            $data['photo3'] = $this->getProfilePhotoThumb($data['id'], $data['photo3']);
            $data['photo4'] = $this->getProfilePhotoThumb($data['id'], $data['photo4']);
            $data['photo5'] = $this->getProfilePhotoThumb($data['id'], $data['photo5']);
            $data['gender'] = $this->getGenderFromID($data['gender']);
            $data['age'] = $this->getAgeFromID($data['age']);
            $data['job_type'] = $this->getJobFromID($data['job_type']);
            $data['experience_years'] = $this->getExperienceYearsFromID($data['experience_years']);
            $cert_id_list = explode(',', $data['certificate']);
            $certificates = $this->getCertificateFromIDs($cert_id_list);
            $data['certificate'] = implode(', ', $certificates);
            $data['hourly_cost'] = '￥' . number_format($data['hourly_cost_from'], 0, '.', ',') . ' ~ ' . '￥' . number_format($data['hourly_cost_to'], 0, '.', ',');

        } catch (QueryException $e) {
            return redirect()->back()->withErrors(['failed' => trans('helper.no_info')]);
        }

        return view('dashboard.helperdetail', $data);
    }
}