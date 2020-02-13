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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('generate-otp','OtpController@store');
Route::get('get-otps','OtpController@index');
Route::get('test','TestController@test');



Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
});


Route::post('logout', 'AuthController@logout');

Route::post('verify-otp','OtpController@verify');

Route::group([
    'middleware' => 'jwt',
], function ($router) {

    //

});