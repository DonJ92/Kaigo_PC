<?php

namespace App\Http\Controllers;


class FavouriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function favouriteJob()
    {
        return view('dashboard.favouritejob');
    }

    public function favouriteHelper()
    {
        return view('dashboard.favouritehelper');
    }
}