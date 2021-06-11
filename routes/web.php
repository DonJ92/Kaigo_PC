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

Route::get('/dashboard/job/register', 'JobManageController@registerForm')->name('dashboard.job.register');
Route::get('/dashboard/job/info/register', 'JobManageController@registerInfoForm')->name('dashboard.job.info.register');
Route::get('/dashboard/job/info/confirm', 'JobManageController@infoConfirmForm')->name('dashboard.job.info.confirm');
Route::get('/dashboard/job/register/confirm', 'JobManageController@registerConfirmForm')->name('dashboard.job.register.confirm');

Route::get('/dashboard/favourite/job', 'FavouriteController@favouriteJob')->name('dashboard.favourite.job');
Route::get('/dashboard/favourite/helper', 'FavouriteController@favouriteHelper')->name('dashboard.favourite.helper');

Route::get('/dashboard/deposit', 'DepositController@depositForm')->name('dashboard.deposit');
Route::get('/dashboard/deposit/confirm', 'DepositController@depositConfirmForm')->name('dashboard.deposit.confirm');

Route::get('/dashboard/txhistory', 'TxHistoryController@txhistory')->name('dashboard.txhistory');
Route::get('/dashboard/receipt/confirm', 'TxHistoryController@receiptConfirm')->name('dashboard.receipt.confirm');

Route::get('/dashboard/identification', 'IdentificationController@identificationForm')->name('dashboard.identification');
Route::get('/dashboard/identification/confirm', 'IdentificationController@identificationConfirm')->name('dashboard.identification.confirm');
Route::get('/dashboard/skill', 'IdentificationController@skillRequestForm')->name('dashboard.skill');
Route::get('/dashboard/skill/confirm', 'IdentificationController@skillRequestConfirm')->name('dashboard.skill.confirm');

Route::get('/dashboard/setting/changepwd', 'SettingController@changePwdForm')->name('dashboard.setting.changepwd');
Route::get('/dashboard/setting/bankaccount', 'SettingController@bankaccountForm')->name('dashboard.setting.bankaccount');
Route::get('/dashboard/setting/creditcard', 'SettingController@creditcardForm')->name('dashboard.setting.creditcard');
Route::get('/dashboard/setting/notification', 'SettingController@notificationForm')->name('dashboard.setting.notification');
Route::get('/dashboard/setting/contactus', 'SettingController@contactUsForm')->name('dashboard.setting.contactus');
Route::get('/dashboard/setting/service', 'SettingController@serviceForm')->name('dashboard.setting.service');