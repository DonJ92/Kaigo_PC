<?php

namespace App\Http\Controllers;


use App\Profile;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function selectForm()
    {
        $profile = $this->getProfile(Auth::user()->id);
        if (!is_null($profile))
            return redirect()->route('home');

        return view('profileselect');
    }

    public function select(Request $request)
    {
        $type = $request->input('type');

        if(is_null($type) || empty($type))
            $type = CLIENT;

        $user = Auth::user();

        $user->type = $type;
        $user->save();

        return redirect()->route('profile.register');
    }

    public function registerForm()
    {
        $data['age_list'] = Config::get('constants.age');
        $data['type_list'] = Config::get('constants.type');
        $data['experience_list'] = Config::get('constants.experience');
        $data['certificate_list'] = $this->getCertificateTypeList();

        return view('profileregister', $data);
    }

    public function register(Request $request)
    {
        $data = $request->all();

        if (Auth::user()->type == CLIENT) {
            $validator = Validator::make($data, [
                'introduction' => 'nullable|string|max:1024',
                'age' => 'nullable',
                'agree' => 'required',
            ], [
            ], [
                'introduction' => trans('profile.introduction'),
                'age' => trans('profile.age'),
            ]);

            $data['experience'] = '';
            $data['certificate'] = '';
        } else
            $validator = Validator::make($data, [
                'introduction' => 'nullable|string|max:1024',
                'age' => 'nullable',
                'experience' => 'required',
                'certificate' => 'required|exists:tbl_certificate_type,id',
                'cost' => 'required',
                'agree' => 'required',
            ], [
            ], [
                'introduction' => trans('profile.introduction'),
                'age' => trans('profile.age'),
                'experience' => trans('profile.experience'),
                'certificate' => trans('profile.certificate'),
                'cost' => trans('profile.hourly_cost'),
            ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }

        return redirect()->back()->withInput()->withErrors(['failed' => trans('profile.register_failed')]);

        try {
            $res = Profile::insert([
                'user_id' => Auth::user()->id,
                'introduction' => $data['introduction'],
                'age' => $data['age'],
                'experience' => $data['experience'],
                'certificate' => $data['certificate'],
                'cost' => $data['cost'],
            ]);
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors(['failed' => trans('profile.register_failed')]);
        }


    }

}