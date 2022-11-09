<?php

use App\Http\Controllers\CountriesController;
use Illuminate\Support\Facades\Route;

Route::get('', [CountriesController::class, 'getCountries']);
Route::get('{country}', [CountriesController::class, 'getCountryWithCities'])
    ->whereNumber('country');
