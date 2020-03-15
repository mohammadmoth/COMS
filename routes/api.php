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
Route::post('register', 'UserController@register');


///Auth here
Route::group(['middleware' => 'auth:api'], function(){
Route::post('details', 'UserController@details');

Route::resource('tags',             'TagsController');
Route::resource('ClinicalExams',             'ClinicalExamController');
Route::resource('Doctors',             'DoctorController');
Route::resource('Sponsors',         'SponsorsController');
Route::resource('Hasfromsponsors',  'HasfromsponsorsController');
Route::resource('Medicines',        'MedicinesController');
Route::resource('Children',         'ChildrensController');
});

//end api
