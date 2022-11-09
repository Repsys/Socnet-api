<?php

namespace App\DTO\User\Profile;

use App\DTO\Base\BaseDataTransferObject;

class UpdateUserProfileData extends BaseDataTransferObject
{
    public ?string $status_text;
    public ?string $birthday;
    public ?string $gender;
    public ?string $relationship;
}
