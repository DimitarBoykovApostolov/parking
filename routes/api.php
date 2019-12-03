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
//Route::put('contracts/{id}', 'ContractController@update');`1
////Route::put('contracts/{id}', 'ContractController@delete');
//Route::delete('contracts/{id}', 'ContractController@destroy');

Route::apiResource('contracts', 'ContractController');

Route::apiResource('estates', 'EstateController');

Route::apiResource('lessors', 'LessorController');

Route::post('contract/relations', 'ContractsEstatesLessors@store');
Route::put('contract/relations/{id}', 'ContractsEstatesLessors@update');
Route::get('contracts/relations{id}', 'ContractController@show');


Route::get('report/owner/rent', 'StatisticController@getReportOwedRent');
Route::get('report/ownership', 'StatisticController@getReportOwnProperties');