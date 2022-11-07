<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Services\External\CountriesNowApiService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class CountrySeeder extends Seeder
{
    public CountriesNowApiService $countriesService;

    public function __construct(CountriesNowApiService $countriesService)
    {
        $this->countriesService = $countriesService;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Country::truncate();

        $countries = $this->countriesService->getCountriesWithCitiesData();
        foreach ($countries as $countryInfo) {
            $countryName = $countryInfo['country'];
            $country = Country::firstOrCreate(['name' => $countryName], Arr::only($countryInfo, ['iso2', 'iso3']));

            $country->cities()->delete();
            foreach ($countryInfo['cities'] as $cityName) {
                $country->cities()->firstOrCreate(['name' => $cityName]);
            }
        }
    }
}
