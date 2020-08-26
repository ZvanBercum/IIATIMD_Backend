<?php

use Illuminate\Support\Facades\Route;


// Laravel homepage
Route::get('/', function () {
    return view('welcome');
});


// medicine routes
Route::get('/medicine/index', 'medicineController@index');
Route::get('/medicine/get/{id}', 'medicineController@get');
Route::post('/medicine/add', 'medicineController@add');

