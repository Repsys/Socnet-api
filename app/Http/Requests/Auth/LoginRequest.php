<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'login' => [
                'required',
                'string',
                'between:3, 254'
            ],
            'password' => [
                'required',
                'string',
                'between:6, 64'
            ]
        ];
    }
}
