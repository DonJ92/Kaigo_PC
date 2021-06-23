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
Route::get('/job/detail/{id}', 'JobController@detail')->name('job.detail');
Route::get('/client/detail/{id}', 'ClientController@detail')->name('client.detail');
Route::get('/helper/search', 'HelperController@search')->name('helper.search');
Route::get('/helper/detail/{id}', 'HelperController@detail')->name('helper.detail');
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
Route::post('/dashboard/home/favourite/helper', 'HomeController@getFavouriteHelper')->name('dashboard.home.favourite.helper');

Route::get('/dashboard/job/search', 'JobController@dashboardSearch')->name('dashboard.job.search');
Route::post('/dashboard/job/getlist', 'JobController@getList')->name('dashboard.job.getlist');
Route::get('/dashboard/job/detail/{id}', 'JobController@dashboardDetail')->name('dashboard.job.detail');

Route::get('/dashboard/helper/search', 'HelperController@dashboardSearch')->name('dashboard.helper.search');
Route::post('/dashboard/helper/getlist', 'HelperController@getList')->name('dashboard.helper.getlist');
Route::get('/dashboard/helper/detail/{id}', 'HelperController@dashboardDetail')->name('dashboard.helper.detail');

Route::get('/dashboard/job/register', 'JobManageController@registerForm')->name('dashboard.job.register');
Route::post('/dashboard/job/info/register', 'JobManageController@register')->name('dashboard.job.register.submit');
Route::get('/dashboard/job/info/register', 'JobManageController@registerInfoForm')->name('dashboard.job.info.register');
Route::post('/dashboard/job/info/confirm', 'JobManageController@registerInfo')->name('dashboard.job.info.register.submit');
Route::get('/dashboard/job/info/confirm', 'JobManageController@infoConfirmForm')->name('dashboard.job.info.confirm');
Route::post('/dashboard/job/register/confirm', 'JobManageController@infoConfirm')->name('dashboard.job.info.confirm.submit');

Route::get('/dashboard/favourite/job', 'FavouriteController@favouriteJob')->name('dashboard.favourite.job');
Route::post('/dashboard/favourite/job', 'FavouriteController@jobFavourite')->name('dashboard.job.favourite');
Route::post('/dashboard/favourite/job/cancel', 'FavouriteController@jobUnFavourite')->name('dashboard.job.favourite.cancel');
Route::get('/dashboard/favourite/helper', 'FavouriteController@favouriteHelper')->name('dashboard.favourite.helper');
Route::post('/dashboard/favourite/helper', 'FavouriteController@helperFavourite')->name('dashboard.helper.favourite');
Route::post('/dashboard/favourite/helper/cancel', 'FavouriteController@helperUnFavourite')->name('dashboard.helper.favourite.cancel');
Route::post('/dashboard/favourite/helper/getlist', 'FavouriteController@getHelperList')->name('dashboard.favourite.helper.getlist');

Route::get('/dashboard/deposit', 'DepositController@depositForm')->name('dashboard.deposit');
Route::get('/dashboard/deposit/confirm', 'DepositController@depositConfirmForm')->name('dashboard.deposit.confirm');

Route::get('/dashboard/txhistory', 'TxHistoryController@txhistory')->name('dashboard.txhistory');
Route::get('/dashboard/receipt/confirm', 'TxHistoryController@receiptConfirm')->name('dashboard.receipt.confirm');

Route::get('/dashboard/identification', 'IdentificationController@identificationForm')->name('dashboard.identification');
Route::post('/dashboard/identification', 'IdentificationController@identification')->name('dashboard.identification.submit');
Route::get('/dashboard/identification/confirm', 'IdentificationController@identificationConfirm')->name('dashboard.identification.confirm');
Route::get('/dashboard/skill', 'IdentificationController@skillRequestForm')->name('dashboard.skill');
Route::get('/dashboard/skill/confirm', 'IdentificationController@skillRequestConfirm')->name('dashboard.skill.confirm');

Route::get('/dashboard/setting/changepwd', 'SettingController@changePwdForm')->name('dashboard.setting.changepwd');
Route::post('/dashboard/setting/changepwd', 'SettingController@changePwd')->name('dashboard.setting.changepwd.submit');
Route::get('/dashboard/setting/bankaccount', 'SettingController@bankAccountForm')->name('dashboard.setting.bankaccount');
Route::post('/dashboard/setting/bankaccount', 'SettingController@bankAccount')->name('dashboard.setting.bankaccount.submit');
Route::get('/dashboard/setting/creditcard', 'SettingController@creditCardForm')->name('dashboard.setting.creditcard');
Route::post('/dashboard/setting/creditcard', 'SettingController@creditCard')->name('dashboard.setting.creditcard.submit');
Route::get('/dashboard/setting/notification', 'SettingController@notificationForm')->name('dashboard.setting.notification');
Route::post('/dashboard/setting/notification', 'SettingController@notification')->name('dashboard.setting.notification.submit');
Route::get('/dashboard/setting/contactus', 'SettingController@contactUsForm')->name('dashboard.setting.contactus');
Route::get('/dashboard/setting/service', 'SettingController@serviceForm')->name('dashboard.setting.service');
Route::post('/dashboard/setting/exit', 'SettingController@exit')->name('dashboard.setting.exit');