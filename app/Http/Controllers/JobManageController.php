<?php

namespace App\Http\Controllers;


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

    public function registerInfoForm()
    {
        return view('dashboard.jobinforegister');
    }

    public function infoConfirmForm()
    {
        return view('dashboard.jobinfoconfirm');
    }

    public function registerConfirmForm()
    {
        return view('dashboard.jobregisterconfirm');
    }
}