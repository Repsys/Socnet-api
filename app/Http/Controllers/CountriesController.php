<?php

namespace App\Http\Controllers;

use App\Helpers\Common\JResponse;
use App\Models\Country;
use App\Services\CountriesService;
use Illuminate\Http\JsonResponse;

class CountriesController extends Controller
{
    public CountriesService $countriesService;

    public function __construct(CountriesService $countriesService)
    {
        $this->countriesService = $countriesService;
    }

    public function getCountries(): JsonResponse
    {
        $response = $this->countriesService->getCountries();
        return JResponse::success($response);
    }

    public function getCountryWithCities(Country $country): JsonResponse
    {
        $response = $this->countriesService->getCountryWithCities($country);
        return JResponse::success($response);
    }
}
