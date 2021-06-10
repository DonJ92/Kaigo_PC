<?php

namespace App\Http\Controllers;


class DepositController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function depositForm()
    {
        return view('dashboard.deposit');
    }

    public function depositConfirmForm()
    {
        return view('dashboard.depositconfirm');
    }
}