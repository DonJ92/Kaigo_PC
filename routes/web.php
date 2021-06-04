<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/register/password', 'Auth\RegisterController@passwordForm')->name('register.passwordform');
Route::post('/register/password', 'Auth\RegisterController@registerPassword')->name('register.password');
Route::get('/register/sms', 'Auth\RegisterController@smsForm')->name('register.smsform');
Route::post('/register/sms', 'Auth\RegisterController@registerSMS')->name('register.sms');
Route::post('/register/confirm', 'Auth\RegisterController@registerConfirm')->name('register.confirm');

Route::get('/', 'TopController@index')->name('top');
Route::get('/job/search', 'JobController@search')->name('job.search');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@selectForm')->name('profile.select');
Route::post('/profile', 'ProfileController@select')->name('profile.select.submit');
Route::get('/profile/register', 'ProfileController@registerForm')->name('profile.register');
Route::post('/profile/register', 'ProfileController@register')->name('profile.register.submit');