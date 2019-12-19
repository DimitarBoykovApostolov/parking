<?php

use \Illuminate\Support\Facades\Route;

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

Route::prefix('parking/')->group(function () {
    Route::get('places/{id}', 'ParkingController@getAvailablePlaces');
    Route::get('fee/{license_plate}', 'ParkingController@getCurrentFee');
    Route::post('registration', 'ParkingController@registration');
    Route::delete('unregister/{license_plate}', 'ParkingController@unregister');
});


