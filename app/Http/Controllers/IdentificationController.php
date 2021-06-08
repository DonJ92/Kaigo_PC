<?php

namespace App\Http\Controllers;


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
        return view('identificationselect');
    }

    public function registerForm()
    {
        $profile = $this->getProfile(Auth::user()->id);
        $age_list = Config::get('constants.age');

        $key = array_search($profile->age, array_column($age_list, 'id'));
        $date['age'] = $age_list[$key]['name'];

        return view('identificationregister', $date);
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

            $location = 'uploads\kyc';
            $user_id_location = '\\' . Auth::user()->id;

            $file->move($location.$user_id_location, $filename);

            $doc = $user_id_location.'\\'.$filename;
        } else
            $doc = '';

        try {
            $res = KYCAuth::insert([
                'user_id' => Auth::user()->id,
                'doc' => $doc,
                'birthday' => $data['birthday'],
            ]);
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

        $key = array_search($profile->certificate, array_column($certificate_list, 'id'));
        $data['certificate'] = $certificate_list[$key]['certificate'];
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

            $location = 'uploads\certificate';
            $user_id_location = '\\' . Auth::user()->id;

            $file->move($location.$user_id_location, $filename);

            $doc = $user_id_location.'\\'.$filename;
        } else
            $doc = '';

        try {
            $res = KYCAuth::insert([
                'user_id' => Auth::user()->id,
                'doc' => $doc,
                'birthday' => $data['birthday'],
            ]);
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors(['failed' => trans('identification.register_failed')]);
        }

        return redirect()->route('identification.confirm')->with('success', trans('identification.register_success'));
    }
}