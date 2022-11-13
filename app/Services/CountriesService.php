<?php

namespace App\Services;

use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;

class CountriesService
{
    public function getCountries(): Collection
    {
        return Country::all();
    }

    public function getCountryWithCities(Country $country): Country
    {
        return $country->load('cities');
    }
}
