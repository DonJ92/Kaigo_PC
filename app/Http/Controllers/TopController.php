<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TopController extends Controller
{
    public function index()
    {
        if (Auth::check())
            $user_id = Auth::user()->id;
        else
            $user_id = 0;

        $helper_list = array();
        try {
            $query = User::leftjoin('tbl_profile', 'tbl_profile.user_id', '=', 'tbl_user.id')
                ->leftjoin('tbl_province', 'tbl_province.id', '=', 'tbl_user.province_id')
                ->leftjoin('tbl_favourite', function($join) use ($user_id)
                {
                    $join->on('tbl_user.id', '=', 'tbl_favourite.target_id');
                    $join->where('tbl_favourite.user_id', '=', $user_id);
                })
                ->leftjoin(DB::raw('(SELECT target_id, count( user_id ) AS favourite_count FROM tbl_favourite GROUP BY target_id) tbl_following'),function($join)
                {
                    $join->on('tbl_user.id', '=', 'tbl_following.target_id');
                })
                ->where('tbl_user.type', HELPER)
                ->select('tbl_user.id', 'tbl_user.last_name', 'tbl_user.first_name', 'tbl_user.gender',
                    'tbl_province.name as province_name', 'tbl_user.address', 'tbl_profile.photo1', 'tbl_profile.photo2',
                    'tbl_profile.photo3', 'tbl_profile.photo4', 'tbl_profile.photo5', 'tbl_profile.age', 'tbl_profile.certificate',
                    'tbl_profile.hourly_cost_from', 'tbl_profile.hourly_cost_to', 'tbl_favourite.id as favourite_id',
                    'tbl_following.favourite_count')
                ->orderby('tbl_following.favourite_count', 'desc')
                ->skip(0)->take(HELPER_HOME_PAGE_CNT);

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
        }

        $data['job_list'] = $this->getJobTypeList();
        $data['province_list'] = $this->getProvinceList();
        $data['helper_list'] = $helper_list;

        return view('welcome', $data);
    }
}