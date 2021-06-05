<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

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
}