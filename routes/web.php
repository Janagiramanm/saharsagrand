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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/','SiteController@index');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::post('/login','UserController@login');
Route::group(['middleware' => ['auth', 'superadmin']], function() {
    Route::get('/admin/home', 'HomeController@index')->name('home');
    Route::post('/user/activate','UserController@activate');
    Route::get('/admin/user-list','UserController@index');
    Route::get('/admin/user/edit/{id}','UserController@edit')->name('user.edit');
    Route::delete('/admin/user/edit/{id}/delete','UserController@destroy')->name('user.destroy');
    Route::put('/admin/user/edit/{id}/update','UserController@update')->name('user.update');
    Route::post('/change-user-status','UserController@changeUserStatus');
   

    Route::get('/admin/blocks','BlockController@index')->name('blocks');
    Route::get('/admin/blocks/add','BlockController@create')->name('block.create');
    Route::post('/admin/block/store','BlockController@store')->name('block.store');
    Route::get('/admin/block/edit/{id}','BlockController@edit')->name('block.edit');
    Route::put('/admin/block/update/{id}','BlockController@update')->name('block.update');

    Route::get('/admin/flats','FlatController@index')->name('flats');
    Route::get('/admin/flats/add','FlatController@create')->name('flat.create');
    Route::post('/admin/flat/store','FlatController@store')->name('flat.store');
    Route::get('/admin/flat/edit/{id}','FlatController@edit')->name('flat.edit');
    Route::put('/admin/flat/update/{id}','FlatController@update')->name('flat.update');

    Route::get('/admin/bookings','BookingController@index');
    Route::get('/admin/bookings/search','BookingController@index')->name('bookings.search');

    Route::get('/admin/amenities','AmenityController@index')->name('amenities');
    Route::get('/admin/amenities/add','AmenityController@create')->name('amenity.create');
    Route::post('/admin/amenities/store','AmenityController@store')->name('amenity.store');
    Route::get('/admin/amenities/edit/{id}','AmenityController@edit')->name('amenity.edit');
    Route::put('/admin/amenities/update/{id}','AmenityController@update')->name('amenity.update');
    Route::post('/admin/amenities/block','AmenityController@block')->name('amenity.block');
    Route::post('/admin/amenities/unblock','AmenityController@unBlock');

    Route::get('/admin/tickers','TickerController@index')->name('tickers');
    Route::get('/admin/tickers/add','TickerController@create')->name('ticker.create');
    Route::get('/admin/tickers/edit/{id}','TickerController@edit')->name('ticker.edit');
    Route::post('/admin/tickers/store','TickerController@store')->name('ticker.store');
    Route::put('/admin/tickers/update/{id}','TickerController@update')->name('ticker.update');

    Route::post('/admin/select-user-notification', 'NotificationController@selectUsers');
    Route::post('/admin/get-sms-template', 'NotificationController@getSmsTemplate');
    Route::resource('/admin/notifications', 'NotificationController');
    Route::resource('/admin/messages', 'MessageController');
    
});

Route::post('/checkflat','UserController@checkFlat');
Route::post('/checkmobile','UserController@checkMobile');
Route::post('/checkemail','UserController@checkEmail');
Route::post('/user/store','UserController@store');
Route::post('/user/mobileVerify','UserController@mobileVerify');
Route::post('/user/change-password','UserController@changePassword');
Route::post('/user/get-flats','UserController@getFlats');
Route::post('/user/forgot-password','UserController@forgotPassword');
Route::post('/user/forgot-password-change','UserController@forgotPasswordChange');
Route::get('/user/reg-success','UserController@regSuccess');
// Route::post('/autocomplete','UserController@selectSearch');
// Route::get('/autocomplete', 'UserController@selectSearch')->name('autocomplete');

Route::post('/search-booking','BookingController@searchBooking');


Route::get('/booking/badminton','BookingController@create')->name('booking.badminton');
