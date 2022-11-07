<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'login' => [
                'string',
                'between:3, 254',
                'unique:users,login'
            ],
            'email' => [
                'string',
                'between:3, 254',
                'email',
                'unique:users,email'
            ],
            'password' => [
                'string',
                'between:6, 64',
                'confirmed'
            ],
            'name' => [
                'string',
                'between:2, 32'
            ],
            'surname' => [
                'string',
                'between:2, 32'
            ],
            'patronymic' => [
                'nullable',
                'string',
                'between:2, 32'
            ]
        ];
    }
}
