<?php

use App\Http\Controllers\Test\TestController;
use Illuminate\Support\Facades\Route;

Route::get('haha', [TestController::class, 'test']);
