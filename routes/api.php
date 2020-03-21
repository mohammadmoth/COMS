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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

//api


Route::post('login', 'UserController@login');


///Auth here
Route::group(['middleware' => 'auth:api'], function () {



    ///rules admin here
    Route::group(['middleware' => 'Rules:admin'], function () {
        Route::apiResource('users',             'UserController');
        Route::post('/users/register', 'UserController@register');
    });



    Route::post('details', 'UserController@details');
    Route::apiResource('tags',             'TagsController');
    Route::apiResource('ClinicalExams',             'ClinicalExamController');
    Route::apiResource('Doctors',             'DoctorController');
    Route::apiResource('Sponsors',         'SponsorsController');
    Route::apiResource('Hasfromsponsors',  'HasfromsponsorsController');
    Route::apiResource('Medicines',        'MedicinesController');
    Route::apiResource('Children',         'ChildrensController');
});
