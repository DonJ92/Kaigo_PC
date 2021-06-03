<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function showRegistrationForm()
    {
        $data['step'] = 1;
        $data['gender_list'] = Config::get('constants.gender');
        $data['province_list'] = $this->getProvinceList();

        return view('auth.register', $data);
    }

    public function passwordForm()
    {
        $old_input = session()->getOldInput();
        if (empty($old_input['last_name']) || empty($old_input['first_name']) || empty($old_input['province']))
            return redirect()->route('register');

        $data['step'] = 2;

        return view('auth.register2', $data);
    }

    public function registerPassword(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'last_name' => 'required|string|max:32',
            'first_name' => 'required|string|max:32',
            'gender' => 'nullable',
            'province' => 'required|exists:tbl_province,id',
            'address' => 'nullable|string|max:256',
        ], [
        ], [
            'last_name' => trans('register.last_name'),
            'first_name' => trans('register.first_name'),
            'gender' => trans('register.gender'),
            'province' => trans('register.province'),
            'address' => trans('register.address'),
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }

        $data['step'] = 2;

        return view('auth.register2', $data);
    }

    public function smsForm()
    {
        $old_input = session()->getOldInput();
        if (empty($old_input['last_name']) || empty($old_input['first_name']) || empty($old_input['province']) || empty($old_input['phone']) || empty($old_input['password']))
            return redirect()->route('register');

        $data['step'] = 3;

        return view('auth.register3', $data);
    }

    public function registerSMS(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'phone' => 'required|string|max:24',
            'password' => 'required|string|min:6|max:32|confirmed',
        ], [
        ], [
            'phone' => trans('register.phone'),
            'password' => trans('register.password'),
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->route('register.passwordform')->withInput()->withErrors($errors);
        }

        $data['step'] = 3;

        return view('auth.register3', $data);
    }

    public function registerConfirm(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'sms_code' => 'required|string',
        ], [
        ], [
            'sms_code' => trans('register.sms_code'),
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->route('register.smsform')->withInput()->withErrors($errors);
        }

        try {
            User::create([
                'phone' => $data['phone'],
                'password' => Hash::make($data['password']),
                'last_name' => $data['last_name'],
                'first_name' => $data['first_name'],
                'gender' => $data['gender'],
                'province_id' => $data['province'],
                'address' => $data['address'],
            ]);
        } catch (QueryException $e) {
            print_r($e->getMessage());
            die();
            return redirect()->route('register')->withInput()->withErrors(['failed' => trans('register.register_failed')]);
        }

        $data['step'] = 4;

        return view('auth.register4', $data);
    }
}
