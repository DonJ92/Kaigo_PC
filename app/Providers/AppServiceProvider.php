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
                $photo = url('uploads/profile') . '/' . Auth::user()->id . '/' . $profile->photo1;
            }

            $data['photo'] = $photo;
            view()->share('data', $data);
        });
    }
}
