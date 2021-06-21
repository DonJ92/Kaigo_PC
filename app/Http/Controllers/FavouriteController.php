<?php

namespace App\Http\Controllers;


use App\Favourite;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavouriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function favouriteJob()
    {
        return view('dashboard.favouritejob');
    }

    public function jobFavourite(Request $request)
    {
        $job_id = $request->input('job_id');

        $user_id = Auth::user()->id;

        try {
            $res = Favourite::insert([
                'user_id' => $user_id,
                'target_id' => $job_id,
                'type' => FAVOURITE_JOB,
            ]);
        } catch (QueryException $e) {
            echo json_encode(false);
            exit;
        }
        echo json_encode(true);
    }

    public function jobUnFavourite(Request $request)
    {
        $job_id = $request->input('job_id');

        $user_id = Auth::user()->id;

        try {
            $res = Favourite::where('user_id', $user_id)
                ->where('target_id', $job_id)
                ->where('type', FAVOURITE_JOB)
                ->delete();
        } catch (QueryException $e) {
            echo json_encode(false);
            exit;
        }
        echo json_encode(true);
    }

    public function favouriteHelper()
    {
        return view('dashboard.favouritehelper');
    }

    public function helperFavourite(Request $request)
    {
        $helper_id = $request->input('helper_id');

        $user_id = Auth::user()->id;

        try {
            $res = Favourite::insert([
                'user_id' => $user_id,
                'target_id' => $helper_id,
                'type' => FAVOURITE_HELPER,
            ]);
        } catch (QueryException $e) {
            echo json_encode(false);
            exit;
        }
        echo json_encode(true);
    }

    public function helperUnFavourite(Request $request)
    {
        $helper_id = $request->input('helper_id');

        $user_id = Auth::user()->id;

        try {
            $res = Favourite::where('user_id', $user_id)
                ->where('target_id', $helper_id)
                ->where('type', FAVOURITE_HELPER)
                ->delete();
        } catch (QueryException $e) {
            echo json_encode(false);
            exit;
        }
        echo json_encode(true);
    }

    public function getHelperList(Request $request)
    {
        $count = $request->input('count');

        $helper_list = array();
        try {
            $query = Favourite::leftjoin('tbl_user', 'tbl_user.id', '=', 'tbl_favourite.target_id')
                ->leftjoin('tbl_profile', 'tbl_profile.user_id', '=', 'tbl_user.id')
                ->leftjoin('tbl_province', 'tbl_province.id', '=', 'tbl_user.province_id')
                ->leftjoin(DB::raw('(SELECT target_id, count( user_id ) AS favourite_count FROM tbl_favourite GROUP BY target_id) tbl_following'),function($join)
                {
                    $join->on('tbl_user.id', '=', 'tbl_following.target_id');
                })
                ->where('tbl_favourite.type', FAVOURITE_HELPER)
                ->where('tbl_favourite.user_id', Auth::user()->id)
                ->select('tbl_user.id', 'tbl_user.last_name', 'tbl_user.first_name', 'tbl_user.gender',
                    'tbl_province.name as province_name', 'tbl_user.address', 'tbl_profile.photo1', 'tbl_profile.photo2',
                    'tbl_profile.photo3', 'tbl_profile.photo4', 'tbl_profile.photo5', 'tbl_profile.age', 'tbl_profile.certificate',
                    'tbl_profile.hourly_cost_from', 'tbl_profile.hourly_cost_to', 'tbl_favourite.id as favourite_id',
                    'tbl_following.favourite_count')
                ->orderby('tbl_following.favourite_count', 'desc')
                ->skip($count)->take(HELPER_FAVOURITE_PAGE_CNT);

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
            echo json_encode( $helper_list );
            exit;
        }

        echo json_encode($helper_list);
    }
}