<?php

namespace App\DTO;

use App\DTO\Base\BaseDataTransferObject;

class CountryAndCityData extends BaseDataTransferObject
{
    public ?int $country_id;
    public ?int $city_id;
}
