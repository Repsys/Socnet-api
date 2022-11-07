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
        $validator = Validator::make(['email' => $this->login], [
            'email' => 'required|email'
        ]);

        $loginFieldName = $validator->passes() ? 'email' : 'login';

       return [
           $loginFieldName => $this->login,
           'password' => $this->password
       ];
    }
}
