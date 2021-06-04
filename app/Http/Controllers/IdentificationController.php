<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;

class IdentificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function selectForm()
    {
        return view('identificationselect');
    }

    public function registerForm()
    {
        return view('identificationregister');
    }

    public function skillForm()
    {
        return view('skillregister');
    }
}