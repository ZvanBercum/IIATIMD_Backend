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
Route::get('/medicine/index', 'medicineController@index');
Route::get('/medicine/get/{id}', 'medicineController@get');
Route::post('/medicine/add', 'medicineController@add');

