<?php

namespace App\Http\Requests\User;

use App\Models\UserProfile;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status_text' => [
                'nullable',
                'string',
                'max:128',
            ],
            'birthday' => [
                'nullable',
                'date_format:Y-m-d'
            ],
            'gender' => [
                'nullable',
                Rule::in(UserProfile::GENDERS)
            ],
            'relationship' => [
                'nullable',
                Rule::in(UserProfile::RELATIONSHIPS)
            ],
            'country_id' => [
                'nullable',
                'integer',
                'exists:countries,id'
            ],
            'city_id' => [
                'nullable',
                'integer',
                'exists:cities,id'
            ]
        ];
    }
}
