<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'login' => [
                'required',
                'string',
                'between:3, 254',
                'unique:users,login'
            ],
            'email' => [
                'required',
                'string',
                'between:3, 254',
                'email',
                'unique:users,email'
            ],
            'password' => [
                'required',
                'string',
                'between:6, 64',
                'confirmed'
            ],
            'name' => [
                'required',
                'string',
                'between:2, 32'
            ],
            'surname' => [
                'required',
                'string',
                'between:2, 32'
            ],
            'patronymic' => [
                'string',
                'between:2, 32'
            ]
        ];
    }
}
