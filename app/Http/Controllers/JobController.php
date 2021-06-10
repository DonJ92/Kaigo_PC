<?php

namespace App\Http\Controllers;


class JobController extends Controller
{
    public function search()
    {
        return view('jobsearch');
    }

    public function detail()
    {
        return view('jobdetail');
    }

}