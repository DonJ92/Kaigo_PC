<?php

namespace App\Http\Controllers;

use App\CertificateType;
use App\JobType;
use App\Profile;
use App\Province;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function getProvinceList()
    {
        $province_list = array();
        try {
            $province_list = Province::orderby('id', 'asc')->get()->toArray();
        } catch (QueryException $e) {
            return $province_list;
        }

        return $province_list;
    }

    protected function getProfile($user_id)
    {
        $profile = array();
        if (is_null($user_id) || empty($user_id))
            return $profile;

        try {
            $profile = Profile::where('user_id', $user_id)->first();
        } catch (QueryException $e) {
            return $profile;
        }

        return $profile;
    }

    protected function getJobTypeList()
    {
        $job_list = array();
        try {
            $job_list = JobType::orderby('id', 'asc')->get()->toArray();
        } catch (QueryException $e) {
            return $job_list;
        }

        return $job_list;
    }

    protected function getCertificateTypeList()
    {
        $certificate_list = array();
        try {
            $certificate_list = CertificateType::orderby('id', 'asc')->get()->toArray();
        } catch (QueryException $e) {
            return $certificate_list;
        }

        return $certificate_list;
    }

    protected function uploadProfilePhoto($file)
    {
        $filename = $file->getClientOriginalName();

        $location = 'uploads\profile\\'.Auth::user()->id;

        $file->move($location, $filename);

        $url = $filename;

        return $url;
    }

    protected function getProfilePhoto($user_info)
    {
        if(!empty($user_info['photo1']))
            $photo = url('uploads/profile') . '/' . $user_info['id'] . '/' . $user_info['photo1'];
        elseif (!empty($user_info['photo2']))
            $photo = url('uploads/profile') . '/' . $user_info['id'] . '/' . $user_info['photo2'];
        elseif (!empty($user_info['photo3']))
            $photo = url('uploads/profile') . '/' . $user_info['id'] . '/' . $user_info['photo3'];
        elseif (!empty($user_info['photo4']))
            $photo = url('uploads/profile') . '/' . $user_info['id'] . '/' . $user_info['photo4'];
        elseif (!empty($user_info['photo5']))
            $photo = url('uploads/profile') . '/' . $user_info['id'] . '/' . $user_info['photo5'];
        else
            $photo = asset('/images/user.png');

        return $photo;
    }

    protected function getGenderFromID($id)
    {
        $gender_list = Config::get('constants.gender');
        $key = array_search($id, array_column($gender_list, 'id'));

        return $gender_list[$key]['name'];
    }

    protected function getAgeFromID($id)
    {
        $age_list = Config::get('constants.age');
        $key = array_search($id, array_column($age_list, 'id'));

        return $age_list[$key]['name'];
    }

    protected function getCertificateFromIDs($id_array)
    {
        $cert_list = $this->getCertificateTypeList();

        $certificates = array();
        foreach ($id_array as $id) {
            $key = array_search($id, array_column($cert_list, 'id'));
            $certificates[] = $cert_list[$key]['certificate'];
        }

        return $certificates;
    }
}
