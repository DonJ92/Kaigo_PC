<?php

namespace App\Providers;

use App\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer([
            'layouts.dashboard', 'layouts.setting'
        ], function($view) {
            $profile = Profile::where('user_id', Auth::user()->id)->first();

            if (is_null($profile))
                $photo = '';
            else {
                if(!empty($profile->photo1))
                    $photo = url('uploads/profile') . '/' . Auth::user()->id . '/' . $profile->photo1;
                elseif (!empty($profile->photo2))
                    $photo = url('uploads/profile') . '/' . Auth::user()->id . '/' . $profile->photo2;
                elseif (!empty($profile->photo3))
                    $photo = url('uploads/profile') . '/' . Auth::user()->id . '/' . $profile->photo3;
                elseif (!empty($profile->photo4))
                    $photo = url('uploads/profile') . '/' . Auth::user()->id . '/' . $profile->photo4;
                elseif (!empty($profile->photo5))
                    $photo = url('uploads/profile') . '/' . Auth::user()->id . '/' . $profile->photo5;
                else
                    $photo = asset('/images/user.png');
            }

            $data['photo'] = $photo;
            view()->share('data', $data);
        });
    }
}
