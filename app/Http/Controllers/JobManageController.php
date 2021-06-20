<?php

namespace App\Http\Controllers;


use App\Job;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class JobManageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function registerForm()
    {
        return view('dashboard.jobregister');
    }

    public function register(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'period' => 'required',
            'from_time' => 'required',
            'to_time' => 'required',
        ], [
        ], [
            'period' => trans('job.register.period'),
            'from_time' => trans('job.register.from_time'),
            'to_time' => trans('job.register.to_time'),
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }

        $data['job_type_list'] = $this->getJobTypeList();
        $data['certificate_list'] = $this->getCertificateTypeList();
        $data['province_list'] = $this->getProvinceList();
        $data['accident_list'] = Config::get('constants.accident');
        $data['traffic_cost_list'] = Config::get('constants.traffic_cost');
        $data['payment_method_list'] = Config::get('constants.payment_method');
        $data['coupon_list'] = Config::get('constants.coupon');

        return view ('dashboard.jobinforegister', $data);
    }

    public function registerInfoForm()
    {
        $old_input = session()->getOldInput();
        if (empty($old_input['period']) || empty($old_input['from_time']) || empty($old_input['to_time']))
            return redirect()->route('dashboard.job.register');

        $data['job_type_list'] = $this->getJobTypeList();
        $data['certificate_list'] = $this->getCertificateTypeList();
        $data['province_list'] = $this->getProvinceList();
        $data['accident_list'] = Config::get('constants.accident');
        $data['traffic_cost_list'] = Config::get('constants.traffic_cost');
        $data['payment_method_list'] = Config::get('constants.payment_method');
        $data['coupon_list'] = Config::get('constants.coupon');

        return view('dashboard.jobinforegister', $data);
    }

    public function registerInfo(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => 'required|string|max:256',
            'type' => 'required|exists:tbl_job_type,id',
            'province' => 'required|exists:tbl_province,id',
            'cost' => 'required|numeric',
            'certificate' => 'required',
            'accident' => 'required',
            'traffic_cost' => 'required',
            'payment_method' => 'required',
            'coupon' => 'required',
            'address' => 'required|string|max:1024',
            'name' => 'required|string|max:64',
            'email' => 'required|string|max:64',
            'phone' => 'required',
            'comment' => 'nullable|string|max:64',
        ], [
        ], [
            'title' => trans('job.register.job_title'),
            'type' => trans('job.register.type'),
            'province' => trans('job.register.province'),
            'cost' => trans('job.register.cost'),
            'certificate' => trans('job.register.certificate'),
            'accident' => trans('job.register.accident'),
            'traffic_cost' => trans('job.register.traffic_cost'),
            'payment_method' => trans('job.register.payment_method'),
            'coupon' => trans('job.register.coupon'),
            'address' => trans('job.register.address'),
            'name' => trans('job.register.name'),
            'email' => trans('job.register.email'),
            'phone' => trans('job.register.phone'),
            'comment' => trans('job.register.comment'),
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }

        $year = date('Y');
        $data['period_info'] = str_replace($year.'/', '', $data['period']);
        $data['type_name'] = $this->getJobFromID($data['type']);
        $data['province_name'] = $this->getProvinceNameFromID($data['province']);
        $data['certificate_name'] = $this->getCertificateFromIDs($data['certificate']);
        $data['accident_type'] = $this->getAccidentTypeFromID($data['accident']);
        $data['traffic_cost_type'] = $this->getTrafficCostTypeFromID($data['traffic_cost']);
        $data['payment_method_type'] = $this->getPaymentMethodTypeFromID($data['payment_method']);
        $data['coupon_type'] = $this->getCouponTypeFromID($data['coupon']);

        return view('dashboard.jobinfoconfirm', $data);
    }

    public function infoConfirmForm()
    {
        $old_input = session()->getOldInput();
        if (empty($old_input['period']) || empty($old_input['from_time']) || empty($old_input['to_time']))
            return redirect()->route('dashboard.job.register');

        if (empty($old_input['title']) || empty($old_input['type']) || empty($old_input['province']) || empty($old_input['cost']) || empty($old_input['certificate'])
            || empty($old_input['accident']) || empty($old_input['traffic_cost']) || empty($old_input['payment_method']) || empty($old_input['coupon'])
            || empty($old_input['address']) || empty($old_input['name']) || empty($old_input['email']) || empty($old_input['phone']))
            return redirect()->route('dashboard.job.info.register');

        $year = date('Y');
        $data['period_info'] = str_replace($year.'/', '', $old_input['period']);
        $data['type_name'] = $this->getJobFromID($old_input['type']);
        $data['province_name'] = $this->getProvinceNameFromID($old_input['province']);
        $data['certificate_name'] = $this->getCertificateFromIDs($old_input['certificate']);
        $data['accident_type'] = $this->getAccidentTypeFromID($old_input['accident']);
        $data['traffic_cost_type'] = $this->getTrafficCostTypeFromID($old_input['traffic_cost']);
        $data['payment_method_type'] = $this->getPaymentMethodTypeFromID($old_input['payment_method']);
        $data['coupon_type'] = $this->getCouponTypeFromID($old_input['coupon']);

        return view('dashboard.jobinfoconfirm', $data);
    }

    public function infoConfirm(Request $request)
    {
        $data = $request->all();

        return redirect()->route('dashboard.job.register')->withErrors(['failed' => trans('job.register.failed')]);

        try {
            Job::insert([
                'user_id' => Auth::user()->id,
                'title' => $data['title'],
                'period' => $data['period'],
                'from_time' => $data['from_time'],
                'to_time' => $data['to_time'],
                'type' => $data['type'],
                'province' => $data['province'],
                'address' => $data['address'],
                'cost' => $data['cost'],
                'certificate' => $data['certificate'],
                'accident' => $data['accident'],
                'traffic_cost' => $data['traffic_cost'],
                'payment_method' => $data['payment_method'],
                'coupon' => $data['coupon'],
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'comment' => $data['comment'],
            ]);
        } catch (QueryException $e) {
            return redirect()->route('dashboard.job.register')->withErrors(['failed' => trans('job.register.failed')]);
        }

        return view('dashboard.jobregisterconfirm');
    }

    public function registerConfirmForm()
    {
        return view('dashboard.jobregisterconfirm');
    }
}