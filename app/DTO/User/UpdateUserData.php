<?php

namespace App\DTO\User;

use App\DTO\Base\BaseDataTransferObject;

class UpdateUserData extends BaseDataTransferObject
{
    public ?string $login;
    public ?string $email;
    public ?string $password;
    public ?string $name;
    public ?string $surname;
    public ?string $patronymic;
}
