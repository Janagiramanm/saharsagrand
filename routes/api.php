<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::post('/login')
Route::post('/login', 'API\UserController@login');
// Route::get('/logged-user', 'API\UserController@loggedUser');
// Route::get('/sahasra-reg-users','UserController@index');

Route::post('/check-availability','API\BookingController@checkAvailability');
