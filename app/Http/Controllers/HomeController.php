<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $status_list = Config::get('constants.user_status');
        $status_id = Auth::user()->status;
        $key = array_search($status_id, array_column($status_list, 'id'));

        $data['status'] = $status_list[$key]['status'];
        return view('home', $data);
    }

    public function getFavouriteHelper(Request $request)
    {
        $helper_list = array();
        try {
            $query = User::leftjoin('tbl_profile', 'tbl_profile.user_id', '=', 'tbl_user.id')
                ->leftjoin('tbl_province', 'tbl_province.id', '=', 'tbl_user.province_id')
                ->leftjoin('tbl_favourite', 'tbl_favourite.target_id', '=', 'tbl_user.id')
                ->where('tbl_user.type', HELPER)
                ->where('tbl_favourite.user_id', Auth::user()->id)
                ->select('tbl_user.id', 'tbl_user.last_name', 'tbl_user.first_name', 'tbl_province.name as province_name', 'tbl_user.address',
                    'tbl_profile.photo1', 'tbl_profile.photo2', 'tbl_profile.photo3', 'tbl_profile.photo4', 'tbl_profile.photo5',
                    'tbl_profile.age', 'tbl_profile.certificate')
                ->orderby('tbl_user.id', 'asc')
                ->skip(0)->take(5);

            $helper_list = $query->get()->toArray();

            for ($i = 0; $i < count($helper_list); $i++) {
                $helper_list[$i]['photo'] = $this->getProfilePhoto($helper_list[$i]);
                $helper_list[$i]['age'] = $this->getAgeFromID($helper_list[$i]['age']);

                $cert_id_list = explode(',', $helper_list[$i]['certificate']);
                $certificates = $this->getCertificateFromIDs($cert_id_list);
                $helper_list[$i]['certificate'] = implode(', ', $certificates);
            }
        } catch (QueryException $e) {
            echo json_encode( $helper_list );
            exit;
        }

        echo json_encode($helper_list);
    }
}
