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
Route::group(['middleware' => ['auth', 'superadmin']], function() {
    Route::get('/admin/home', 'HomeController@index')->name('home');
    Route::post('/user/activate','UserController@activate');
    Route::get('/admin/user-list','UserController@index');

    Route::get('/admin/blocks','BlockController@index')->name('blocks');
    Route::get('/admin/block/add','BlockController@create')->name('block.create');
    Route::post('/admin/block/store','BlockController@store')->name('block.store');
    Route::get('/admin/block/edit/{id}','BlockController@edit')->name('block.edit');
    Route::put('/admin/block/update/{id}','BlockController@update')->name('block.update');

    Route::get('/admin/flats','FlatController@index')->name('flats');
    Route::get('/admin/flat/add','FlatController@create')->name('flat.create');
    Route::post('/admin/flat/store','FlatController@store')->name('flat.store');
    Route::get('/admin/flat/edit/{id}','FlatController@edit')->name('flat.edit');
    Route::put('/admin/flat/update/{id}','FlatController@update')->name('flat.update');
});

Route::post('/checkemail','UserController@checkEmail');
Route::post('/user/store','UserController@store');
Route::post('/user/mobileVerify','UserController@mobileVerify');
Route::post('/user/change-password','UserController@changePassword');


Route::get('/booking/badminton','BookingController@create');
