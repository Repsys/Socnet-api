<?php

namespace App\DTO\Auth;

use App\DTO\Base\BaseDataTransferObject;
use Illuminate\Support\Facades\Validator;

class LoginData extends BaseDataTransferObject
{
    public string $login;
    public string $password;

    public function getCredentials(): array
    {
        $emailValidator = Validator::make(['email' => $this->login], [
            'email' => 'required|email'
        ]);

        $loginFieldName = $emailValidator->passes() ? 'email' : 'login';

       return [
           $loginFieldName => $this->login,
           'password' => $this->password
       ];
    }
}
