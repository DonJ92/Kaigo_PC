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
        $profile = $this->getProfile(Auth::user()->id);
        if (!is_null($profile))
            return redirect()->route('home');

        $data['age_list'] = Config::get('constants.age');
        $data['type_list'] = Config::get('constants.type');
        $data['experience_list'] = Config::get('constants.experience');
        $data['job_list'] = $this->getJobTypeList();
        $data['certificate_list'] = $this->getCertificateTypeList();

        return view('profileregister', $data);
    }

    public function register(Request $request)
    {
        $data = $request->all();

        if (Auth::user()->type == CLIENT) {
            $validator = Validator::make($data, [
                'photo1' => 'nullable|image|mimes:jpeg,png,jpg,gif,bmp,svg',
                'photo2' => 'nullable|image|mimes:jpeg,png,jpg,gif,bmp,svg',
                'photo3' => 'nullable|image|mimes:jpeg,png,jpg,gif,bmp,svg',
                'photo4' => 'nullable|image|mimes:jpeg,png,jpg,gif,bmp,svg',
                'photo5' => 'nullable|image|mimes:jpeg,png,jpg,gif,bmp,svg',
                'introduction' => 'nullable|string|max:1024',
                'age' => 'nullable',
                'agree' => 'required',
            ], [
            ], [
                'photo1' => trans('profile.photo1'),
                'photo2' => trans('profile.photo2'),
                'photo3' => trans('profile.photo3'),
                'photo4' => trans('profile.photo4'),
                'photo5' => trans('profile.photo5'),
                'introduction' => trans('profile.introduction'),
                'age' => trans('profile.age'),
            ]);

            $data['experience_years'] = null;
            $data['certificate'] = null;
            $data['hourly_cost_from'] = null;
            $data['hourly_cost_to'] = null;
        } else
            $validator = Validator::make($data, [
                'photo1' => 'nullable|image|mimes:jpeg,png,jpg,gif,bmp,svg',
                'photo2' => 'nullable|image|mimes:jpeg,png,jpg,gif,bmp,svg',
                'photo3' => 'nullable|image|mimes:jpeg,png,jpg,gif,bmp,svg',
                'photo4' => 'nullable|image|mimes:jpeg,png,jpg,gif,bmp,svg',
                'photo5' => 'nullable|image|mimes:jpeg,png,jpg,gif,bmp,svg',
                'introduction' => 'nullable|string|max:1024',
                'age' => 'nullable',
                'job_type' => 'required|exists:tbl_job_type,id',
                'experience_years' => 'required',
                'certificate' => 'required',
                'hourly_cost_from' => 'required|numeric',
                'hourly_cost_to' => 'required|numeric|gte:hourly_cost_from',
                'agree' => 'required',
            ], [
            ], [
                'photo1' => trans('profile.photo1'),
                'photo2' => trans('profile.photo2'),
                'photo3' => trans('profile.photo3'),
                'photo4' => trans('profile.photo4'),
                'photo5' => trans('profile.photo5'),
                'introduction' => trans('profile.introduction'),
                'age' => trans('profile.age'),
                'job_type' => trans('profile.job_type'),
                'experience_years' => trans('profile.experience_years'),
                'certificate' => trans('profile.certificate'),
                'hourly_cost_from' => trans('profile.hourly_cost'),
                'hourly_cost_to' => trans('profile.hourly_cost'),
            ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }

        $data['certificate'] = implode(',', $data['certificate']);

        if($request->hasFile('photo1'))
        {
            $image_file = $request->file('photo1');
            $photo1 = $this->uploadProfilePhoto($image_file);
        } else
            $photo1 = '';

        if($request->hasFile('photo2'))
        {
            $image_file = $request->file('photo2');
            $photo2 = $this->uploadProfilePhoto($image_file);
        } else
            $photo2 = '';

        if($request->hasFile('photo3'))
        {
            $image_file = $request->file('photo3');
            $photo3 = $this->uploadProfilePhoto($image_file);
        } else
            $photo3 = '';

        if($request->hasFile('photo4'))
        {
            $image_file = $request->file('photo4');
            $photo4 = $this->uploadProfilePhoto($image_file);
        } else
            $photo4 = '';

        if($request->hasFile('photo5'))
        {
            $image_file = $request->file('photo5');
            $photo5 = $this->uploadProfilePhoto($image_file);
        } else
            $photo5 = '';

        try {
            $res = Profile::insert([
                'user_id' => Auth::user()->id,
                'introduction' => $data['introduction'],
                'photo1' => $photo1,
                'photo2' => $photo2,
                'photo3' => $photo3,
                'photo4' => $photo4,
                'photo5' => $photo5,
                'age' => $data['age'],
                'job_type' => $data['job_type'],
                'experience_years' => $data['experience_years'],
                'certificate' => $data['certificate'],
                'hourly_cost_from' => $data['hourly_cost_from'],
                'hourly_cost_to' => $data['hourly_cost_to'],
            ]);
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors(['failed' => trans('profile.register_failed')]);
        }

        return redirect()->route('identification.select')->with('success', trans('profile.register_success'));
    }

}