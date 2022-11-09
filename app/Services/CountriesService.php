<?php

namespace App\Services;

use App\Models\Country;
use App\Services\External\CountriesNowApiService;
use Illuminate\Database\Eloquent\Collection;

class CountriesService
{
    public CountriesNowApiService $countriesNowApiService;

    public function __construct(CountriesNowApiService $countriesNowApiService)
    {
        $this->countriesNowApiService = $countriesNowApiService;
    }

    public function getCountries(): Collection
    {
        return Country::all();
    }

    public function getCountryWithCities(Country $country): Country
    {
        return $country->load('cities');
    }
}
