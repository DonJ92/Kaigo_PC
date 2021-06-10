<?php

namespace App\Http\Controllers;


class TxHistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function txhistory()
    {
        return view('dashboard.txhistory');
    }

    public function receiptConfirm()
    {
        return view('dashboard.receiptconfirm');
    }

}