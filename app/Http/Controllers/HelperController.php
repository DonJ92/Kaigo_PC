<?php

namespace App\Http\Controllers;


class HelperController extends Controller
{
    public function search()
    {
        return view('helpersearch');
    }

    public function detail()
    {
        return view('helperdetail');
    }
}