<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::Resource('/user', App\Http\Controllers\UserController::class);
Route::Resource('/action', App\Http\Controllers\ActionController::class);
Route::Resource('/converter', App\Http\Controllers\ConverterController::class);

