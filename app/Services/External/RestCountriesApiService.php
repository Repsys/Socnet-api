<?php

namespace App\Services\External;

class RestCountriesApiService extends ExternalJsonApiService
{
    public function getApiDomain()
    {
        return config('services.rest_countries.domain');
    }

    public function getCountriesWithCitiesData(): array
    {
        $action = '/all';
        $params = [
            'fields' => 'name'
        ];

        $response = $this->sendGet($action, $params);

        return $response;
    }
}
