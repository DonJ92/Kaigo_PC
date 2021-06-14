<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $status_list = Config::get('constants.user_status');
        $status_id = Auth::user()->status;
        $key = array_search($status_id, array_column($status_list, 'id'));

        $data['status'] = $status_list[$key]['status'];
        return view('home', $data);
    }
}
