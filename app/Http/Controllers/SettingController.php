<?php

namespace App\Http\Controllers;


class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function changePwdForm()
    {
        return view('dashboard.changepwd');
    }

    public function bankaccountForm()
    {
        return view('dashboard.bankaccount');
    }

    public function creditcardForm()
    {
        return view('dashboard.creditcard');
    }

    public function notificationForm()
    {
        return view('dashboard.notification');
    }

    public function contactUsForm()
    {
        return view('dashboard.contactus');
    }

    public function serviceForm()
    {
        return view('dashboard.service');
    }
}