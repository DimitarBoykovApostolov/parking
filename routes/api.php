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

Route::apiResource('contracts', 'ContractController');

Route::apiResource('estates', 'EstateController');

Route::apiResource('lessors', 'LessorController');

Route::put('contract/relations/{id}', 'ContractsEstatesLessors@update');

Route::prefix('report/contract/')->group(function () {
    Route::get('rent', 'ReportController@getReportOwnedRent');
    Route::get('ownership', 'ReportController@getReportOwnProperties');
});

