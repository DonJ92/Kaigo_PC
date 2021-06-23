<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function detail($id)
    {
        try {
            $helper_info = User::leftjoin('tbl_profile', 'tbl_profile.user_id', '=', 'tbl_user.id')
                ->leftjoin('tbl_province', 'tbl_province.id', '=', 'tbl_user.province_id')
                ->where('tbl_user.id', $id)
                ->select('tbl_user.id', 'tbl_user.last_name', 'tbl_user.first_name', 'tbl_user.gender', 'tbl_province.name as province_name', 'tbl_user.address',
                    'tbl_profile.introduction', 'tbl_profile.photo1', 'tbl_profile.photo2', 'tbl_profile.photo3', 'tbl_profile.photo4', 'tbl_profile.photo5',
                    'tbl_profile.age')
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

        } catch (QueryException $e) {
            return redirect()->back()->withErrors(['failed' => trans('helper.no_info')]);
        }

        return view('clientdetail', $data);
    }
}