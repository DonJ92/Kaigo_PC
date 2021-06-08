<?php

namespace App\Http\Controllers;


class TopController extends Controller
{
    public function index()
    {
        $data['job_list'] = $this->getJobTypeList();
        $data['province_list'] = $this->getProvinceList();

        return view('welcome', $data);
    }
}