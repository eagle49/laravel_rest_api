<?php

use Illuminate\Http\Request;

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

// For login
Route::post('getlogin','UserController@getlogin');
Route::post('getsignup','UserController@getsignup');
Route::get('getverify/{verify_code}', 'UserController@getverify');
Route::get('sendvcode/{email}', 'UserController@sendvcode');

