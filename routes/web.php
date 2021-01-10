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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::post('/login','UserController@login');
Route::get('/admin/home', 'HomeController@index')->name('home');

Route::post('/checkemail','UserController@checkEmail');
//Route::post('/checkotp','UserController@checkOTP');
Route::post('/user/store','UserController@store');
Route::post('/user/mobileVerify','UserController@mobileVerify');
Route::get('/admin/user-list','UserController@index');

Route::get('/booking/badminton','BookingController@create');
