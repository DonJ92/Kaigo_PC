<?php

namespace App\Http\Controllers;


class TopController extends Controller
{
    public function index()
    {
        $data['certificate_list'] = $this->getCertificateTypeList();
        $data['province_list'] = $this->getProvinceList();

        return view('welcome', $data);
    }
}