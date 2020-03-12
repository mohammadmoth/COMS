<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/app','vuejsAppController@app');

Route::resource('api/tags', 'TagsController');
Route::resource('api/Sponsors', 'SponsorsController');
Route::resource('api/Hasfromsponsors', 'HasfromsponsorsController');
Route::resource('api/Medicines', 'MedicinesController');
Route::resource('api/Children', 'ChildrenController');









//////////////////////vuejs
Route::get('/{all}','vuejsAppController@index')->where("all",".*");
Route::get('login', function () {
})->name("login");





