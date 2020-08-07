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

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::resource('analyses', 'AnalysisController');
    Route::resource('genes', 'GeneController');
    Route::resource('patients', 'PatientController');
    Route::resource('materials', 'MaterialTypeController');
    Route::resource('pay-types', 'PayTypeController');
    Route::resource('institutions', 'InstitutionController');
    Route::resource('users', 'UserController');
    Route::resource('researches', 'ResearchController');
});
