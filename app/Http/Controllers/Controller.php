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
}
