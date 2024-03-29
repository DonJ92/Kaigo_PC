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

    protected function getProfilePhotoThumb($user_id, $photo)
    {
        if(!empty($photo))
            $preview_photo = url('uploads/profile') . '/' . $user_id . '/' . $photo;
        else
            $preview_photo = asset('/images/gallery.svg');

        return $preview_photo;
    }

    protected function getGenderFromID($id)
    {
        if (is_null($id) || empty($id))
            return trans('common.unknown');

        $gender_list = Config::get('constants.gender');
        $key = array_search($id, array_column($gender_list, 'id'));

        return $gender_list[$key]['name'];
    }

    protected function getAgeFromID($id)
    {
        if (is_null($id) || empty($id))
            return trans('common.unknown');

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

    protected function getJobFromID($id)
    {
        if (is_null($id) || empty($id))
            return trans('common.unknown');

        $job_type_list = $this->getJobTypeList();

        $key = array_search($id, array_column($job_type_list, 'id'));

        return $job_type_list[$key]['job_type'];
    }

    protected function getProvinceNameFromID($id)
    {
        if (is_null($id) || empty($id))
            return trans('common.unknown');

        $province_list = $this->getProvinceList();

        $key = array_search($id, array_column($province_list, 'id'));

        return $province_list[$key]['name'];
    }

    public function getExperienceYearsFromID($id)
    {
        if (is_null($id) || empty($id))
            return trans('common.unknown');

        $experience_years_list = Config::get('constants.experience');

        $key = array_search($id, array_column($experience_years_list, 'id'));

        return $experience_years_list[$key]['name'];
    }

    public function getAccidentTypeFromID($id)
    {
        if (is_null($id) || empty($id))
            return trans('common.unknown');

        $accident_list = Config::get('constants.accident');

        $key = array_search($id, array_column($accident_list, 'id'));

        return $accident_list[$key]['type'];
    }

    public function getTrafficCostTypeFromID($id)
    {
        if (is_null($id) || empty($id))
            return trans('common.unknown');

        $traffic_cost_list = Config::get('constants.traffic_cost');

        $key = array_search($id, array_column($traffic_cost_list, 'id'));

        return $traffic_cost_list[$key]['type'];
    }

    public function getPaymentMethodTypeFromID($id)
    {
        if (is_null($id) || empty($id))
            return trans('common.unknown');

        $payment_method_list = Config::get('constants.payment_method');

        $key = array_search($id, array_column($payment_method_list, 'id'));

        return $payment_method_list[$key]['type'];
    }

    public function getCouponTypeFromID($id)
    {
        if (is_null($id) || empty($id))
            return trans('common.unknown');

        $coupon_list = Config::get('constants.coupon');

        $key = array_search($id, array_column($coupon_list, 'id'));

        return $coupon_list[$key]['type'];
    }
}
