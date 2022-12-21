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

// Registrar Usuario, devuelve token
Route::post('/auth/register', [AuthC::class, 'createUser']);
// Loguear usuario, deuvelve token
Route::post('/auth/login', [AuthC::class, 'loginUser']);

//Route::post('/auth/login', 'App\Http\Controllers\AuthController@loginUser');


//Route::post('login', [App\Http\Controllers\Api\LoginController::class, 'login']);
// Listado de clientes, necesario token para autorización
Route::apiResource('clients', ClientC::class)->middleware('auth:sanctum');
// Devuelve un cliente, necesario token para autorización.
Route::get('/clients/{id}}', [ClientC::class, 'show'])->middleware('auth:sanctum');

