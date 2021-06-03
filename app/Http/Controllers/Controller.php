<?php

namespace App\Http\Controllers;

use App\Province;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function getProvinceList()
    {
        $province_list = array();
        try {
            $province_list = Province::orderby('id', 'asc')->get()->toArray();
        } catch (QueryException $e) {
            return $province_list;
        }

        return $province_list;
    }
}
