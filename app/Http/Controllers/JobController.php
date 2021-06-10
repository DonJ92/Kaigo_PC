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

    public function dashboardSearch()
    {
        $this->middleware('auth');
        return view('dashboard.jobsearch');
    }

    public function dashboardDetail()
    {
        $this->middleware('auth');
        return view('dashboard.jobdetail');
    }
}