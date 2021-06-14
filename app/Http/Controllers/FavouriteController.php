<?php

namespace App\Http\Controllers;


use App\Favourite;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function helperFavourite(Request $request)
    {
        $helper_id = $request->input('helper_id');

        $user_id = Auth::user()->id;

        try {
            $res = Favourite::insert([
                'user_id' => $user_id,
                'target_id' => $helper_id,
                'type' => FAVOURITE_HELPER,
            ]);
        } catch (QueryException $e) {
            echo json_encode(false);
            exit;
        }
        echo json_encode(true);
    }

    public function helperUnFavourite(Request $request)
    {
        $helper_id = $request->input('helper_id');

        $user_id = Auth::user()->id;

        try {
            $res = Favourite::where('user_id', $user_id)
                ->where('target_id', $helper_id)
                ->where('type', FAVOURITE_HELPER)
                ->delete();
        } catch (QueryException $e) {
            echo json_encode(false);
            exit;
        }
        echo json_encode(true);
    }
}