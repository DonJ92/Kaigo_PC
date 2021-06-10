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
Route::get('/job/detail', 'JobController@detail')->name('job.detail');
Route::get('/client/detail', 'ClientController@detail')->name('client.detail');
Route::get('/helper/search', 'HelperController@search')->name('helper.search');
Route::get('/helper/detail', 'HelperController@detail')->name('helper.detail');
Route::get('/contactus', 'ContactUSController@index')->name('contactus');

Route::get('/profile', 'ProfileController@selectForm')->name('profile.select');
Route::post('/profile', 'ProfileController@select')->name('profile.select.submit');
Route::get('/profile/register', 'ProfileController@registerForm')->name('profile.register');
Route::post('/profile/register', 'ProfileController@register')->name('profile.register.submit');

Route::get('/identification', 'IdentificationController@selectForm')->name('identification.select');
Route::get('/identification/register', 'IdentificationController@registerForm')->name('identification.register');
Route::post('/identification/register', 'IdentificationController@register')->name('identification.register.submit');
Route::get('/identification/confirm', 'IdentificationController@confirm')->name('identification.confirm');
Route::get('/skill/register', 'IdentificationController@skillForm')->name('skill.register');
Route::post('/skill/register', 'IdentificationController@skillRegister')->name('skill.register.submit');
Route::get('/skill/confirm', 'IdentificationController@skillConfirm')->name('skill.confirm');

Route::get('/dashboard/home', 'HomeController@index')->name('dashboard.home');
Route::get('/dashboard/job/search', 'JobController@dashboardSearch')->name('dashboard.job.search');
Route::get('/dashboard/job/detail', 'JobController@dashboardDetail')->name('dashboard.job.detail');