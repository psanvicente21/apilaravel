<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController as ClientC;
use App\Http\Controllers\AuthController as AuthC;


/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::post('auth/register', [AuthC::class, 'createUser']);
Route::post('/auth/login', [AuthC::class, 'loginUser']);

//Route::post('/auth/login', 'App\Http\Controllers\AuthController@loginUser');


//Route::post('login', [App\Http\Controllers\Api\LoginController::class, 'login']);
Route::apiResource('clients', ClientC::class)->middleware('auth:sanctum');
//Route::apiResource('clients', ClientC::class);
