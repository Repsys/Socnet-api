<?php

use App\Http\Controllers\User\UserController;


Route::post('', [UserController::class, 'createUser']);

Route::get('{user}', [UserController::class, 'getUser'])
    ->whereNumber('user');

Route::get('', [UserController::class, 'getUsers']);


Route::middleware('auth:api')->group(function () {
    Route::get('me', [UserController::class, 'getMe']);
    Route::put('me', [UserController::class, 'updateMe']);
    Route::put('me/profile', [UserController::class, 'updateMyProfile']);
});

