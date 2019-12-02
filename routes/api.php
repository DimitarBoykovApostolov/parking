<?php

use Illuminate\Http\Request;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::get('contracts', 'ContractController@index');
//Route::get('contracts/{id}', 'ContractController@show');
//Route::post('contracts', 'ContractController@store');
//Route::put('contracts/{id}', 'ContractController@update');
////Route::put('contracts/{id}', 'ContractController@delete');
//Route::delete('contracts/{id}', 'ContractController@destroy');

Route::apiResource('contracts', 'ContractController');

Route::apiResource('estates', 'EstateController');

Route::apiResource('lessors', 'LessorController');


