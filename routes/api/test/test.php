<?php

use App\Http\Controllers\Test\TestController;
use Illuminate\Support\Facades\Route;

Route::get('test', [TestController::class, 'test']);
