<?php

namespace App\Http\Controllers;


use App\CertificateAuth;
use App\KYCAuth;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class IdentificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function selectForm()
    {
        $profile = $this->getProfile(Auth::user()->id);
        if (is_null($profile))
            return redirect()->route('profile.select');

        return view('identificationselect');
    }

    public function registerForm()
    {
        $profile = $this->getProfile(Auth::user()->id);
        $age_list = Config::get('constants.age');

        $key = array_search($profile->age, array_column($age_list, 'id'));
        $data['age'] = $age_list[$key]['name'];

        return view('identificationregister', $data);
    }

    public function register(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'doc' => 'required|image|mimes:jpeg,png,jpg,gif,bmp,svg',
            'birthday' => 'nullable|date',
        ], [
        ], [
            'doc' => trans('identification.doc'),
            'birthday' => trans('identification.birthday'),
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }

        if($request->hasFile('doc'))
        {
            $file = $request->file('doc');
            $filename = $file->getClientOriginalName();

            $location = 'uploads\kyc\\' . Auth::user()->id;

            $file->move($location, $filename);

            $doc = $filename;
        } else
            $doc = '';

        try {
            $res = KYCAuth::insert([
                'user_id' => Auth::user()->id,
                'doc' => $doc,
                'birthday' => $data['birthday'],
            ]);

            $user = Auth::user();
            $user->status = USER_PENDING;
            $user->save();

        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors(['failed' => trans('identification.register_failed')]);
        }

        return redirect()->route('identification.confirm')->with('success', trans('identification.register_success'));
    }

    public function confirm()
    {
        return view('identificationconfirm');
    }

    public function skillForm()
    {
        $profile = $this->getProfile(Auth::user()->id);
        $certificate_list = $this->getCertificateTypeList();

        $cert_list = explode(',', $profile->certificate);

        foreach ($cert_list as $cert_id) {
            $key = array_search($cert_id, array_column($certificate_list, 'id'));
            $cert_arr[] = $certificate_list[$key]['certificate'];
        }
        $data['certificate'] = implode(',', $cert_arr);
        $data['certificate_id'] = $profile->certificate;
        $data['certificate_list'] = $certificate_list;

        return view('skillregister', $data);
    }

    public function skillRegister(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'doc' => 'required|image|mimes:jpeg,png,jpg,gif,bmp,svg',
            'certificate' => 'nullable||exists:tbl_certificate_type,id',
        ], [
        ], [
            'doc' => trans('identification.doc'),
            'certificate' => trans('identification.certificate'),
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }

        if($request->hasFile('doc'))
        {
            $file = $request->file('doc');
            $filename = $file->getClientOriginalName();

            $location = 'uploads\certificate\\' . Auth::user()->id;

            $file->move($location, $filename);

            $doc = $filename;
        } else
            $doc = '';

        try {
            $res = CertificateAuth::insert([
                'user_id' => Auth::user()->id,
                'doc' => $doc,
                'certificate' => $data['certificate'],
            ]);
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors(['failed' => trans('identification.skill_register_failed')]);
        }

        return redirect()->route('skill.confirm')->with('success', trans('identification.skill_register_success'));
    }

    public function skillConfirm()
    {
        return view('skillconfirm');
    }

    public function identificationForm()
    {
        $profile = $this->getProfile(Auth::user()->id);
        $age_list = Config::get('constants.age');

        $key = array_search($profile->age, array_column($age_list, 'id'));
        $data['age'] = $age_list[$key]['name'];

        return view('dashboard.identification', $data);
    }

    public function identification(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'doc' => 'required|image|mimes:jpeg,png,jpg,gif,bmp,svg',
            'birthday' => 'nullable|date',
        ], [
        ], [
            'doc' => trans('identification.doc'),
            'birthday' => trans('identification.birthday'),
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }

        $user = Auth::user();

        if($request->hasFile('doc'))
        {
            $file = $request->file('doc');
            $filename = $file->getClientOriginalName();

            $location = 'uploads\kyc\\' . $user->id;

            $file->move($location, $filename);

            $doc = $filename;
        } else
            $doc = '';

        try {
            $kyc_info = KYCAuth::where('user_id', $user->id)->first();

            if (is_null($kyc_info))
                $res = KYCAuth::insert([
                    'user_id' => Auth::user()->id,
                    'doc' => $doc,
                    'birthday' => $data['birthday'],
                ]);
            else {
                $kyc_info->doc = $doc;
                $kyc_info->birthday = $data['birthday'];
                $kyc_info->save();
            }

            $user->status = USER_PENDING;
            $user->save();

        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors(['failed' => trans('identification.register_failed')]);
        }

        return redirect()->route('dashboard.identification.confirm')->with('success', trans('identification.register_success'));
    }

    public function identificationConfirm()
    {
        return view('dashboard.identificationconfirm');
    }

    public function skillRequestForm()
    {
        $profile = $this->getProfile(Auth::user()->id);
        $certificate_list = $this->getCertificateTypeList();

        $cert_list = explode(',', $profile->certificate);

        foreach ($cert_list as $cert_id) {
            $key = array_search($cert_id, array_column($certificate_list, 'id'));
            $cert_arr[] = $certificate_list[$key]['certificate'];
        }
        $data['certificate'] = implode(',', $cert_arr);
        $data['certificate_id'] = $profile->certificate;
        $data['certificate_list'] = $certificate_list;

        return view('dashboard.skill', $data);
    }

    public function skillRequestConfirm()
    {
        return view('dashboard.skillconfirm');
    }
}