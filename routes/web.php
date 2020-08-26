<?php

use Illuminate\Support\Facades\Route;


// Laravel homepage
Route::get('/', function () {
    return view('welcome');
});


// medicine routes
Route::get('/medicine/index', 'medicineController@index')->middleware('checkToken');
Route::get('/medicine/get/{id}', 'medicineController@get')->middleware('checkToken');

