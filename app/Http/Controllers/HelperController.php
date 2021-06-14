<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HelperController extends Controller
{
    public function search()
    {
        return view('helpersearch');
    }

    public function detail()
    {
        return view('helperdetail');
    }

    public function dashboardSearch()
    {
        return view('dashboard.helpersearch');
    }

    public function getList(Request $request)
    {
        $count = $request->input('count');

        $helper_list = array();
        try {
            $query = User::leftjoin('tbl_profile', 'tbl_profile.user_id', '=', 'tbl_user.id')
                ->leftjoin('tbl_province', 'tbl_province.id', '=', 'tbl_user.province_id')
                ->leftjoin('tbl_favourite', function($join)
                {
                    $join->on('tbl_user.id', '=', 'tbl_favourite.target_id');
                    $join->where('tbl_favourite.user_id', '=', Auth::user()->id);
                })
                ->where('tbl_user.type', HELPER)
                ->select('tbl_user.id', 'tbl_user.last_name', 'tbl_user.first_name', 'tbl_user.gender',
                    'tbl_province.name as province_name', 'tbl_user.address', 'tbl_profile.photo1', 'tbl_profile.photo2',
                    'tbl_profile.photo3', 'tbl_profile.photo4',
                    'tbl_profile.photo5', 'tbl_profile.age', 'tbl_profile.certificate',
                    'tbl_profile.hourly_cost_from', 'tbl_profile.hourly_cost_to', 'tbl_favourite.id as favourite_id')
                ->orderby('tbl_user.id', 'asc')
                ->skip($count)->take(HELPER_PAGE_CNT);

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

    public function dashboardDetail()
    {
        return view('dashboard.helperdetail');
    }
}