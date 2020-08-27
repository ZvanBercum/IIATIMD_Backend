<?php

use Illuminate\Support\Facades\Route;


// Laravel homepage
Route::get('/', function () {
    return view('welcome');
});

// Authenitcation routes
Route::group(['prefix' => 'api'], function()
{
    Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);

    // route:: localhost/api/authenticate
    Route::post('authenticate', 'AuthenticateController@authenticate');
});

Route::get('/checkIfAuthenticated', 'AuthenticateController@checkIfAuthenticated')->middleware('checkToken');

// medicine routes
Route::get('/medicine/index', 'medicineController@index')->middleware('checkToken');
Route::get('/medicine/get/{id}', 'medicineController@get')->middleware('checkToken');
Route::post('/medicine/add', 'medicineController@add')->middleware('checkToken');

// reminder routes
Route::post('/reminder/add', 'reminderController@add')->middleware('checkToken');
