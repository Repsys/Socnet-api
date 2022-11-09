<?php

namespace App\Services\External;

class CountriesNowApiService extends ExternalJsonApiService
{
    public function getApiDomain()
    {
        return config('services.countries_now.domain');
    }

    public function formatResponse(array $response): array
    {
        return $response['data'];
    }

    public function getCountries(): array
    {
        $action = '/countries';
        $response = $this->sendGet($action);

        return $response;
    }
}
