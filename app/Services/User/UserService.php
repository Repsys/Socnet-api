<?php

namespace App\Services\User;

use App\DTO\CountryAndCityData;
use App\DTO\User\CreateUserData;
use App\DTO\User\Profile\UpdateUserProfileData;
use App\DTO\User\UpdateUserData;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Paginator;

class UserService
{
    public function createUser(CreateUserData $data): User
    {
        DB::beginTransaction();
        $user = User::create($data->all());
        $user->profile()->create();
        DB::commit();

        // TODO Подтверждение почты (и смена пароля мб так же):
        // TODO 1 апи, которая генерирует ключ, записывает в кэш и отправляет письмо с ним на почту
        // TODO 2 апи, которая проверяет что указанный ключ совпадает с ключом в кеше и подтверждает аккаунт

        return $user;
    }

    public function updateUser(User $user, UpdateUserData $data): void
    {
        $user->update($data->onlyFilled());
    }

    public function updateUserProfile(User $user, UpdateUserProfileData $profileData, CountryAndCityData $countryData): void
    {
        $profile = $user->profile;

        DB::beginTransaction();
        $profile->update($profileData->onlyFilled());
        $profile->updateCountryAndCity($countryData);
        DB::commit();
    }

    public function getUser(User $user): User
    {
        return $user->load('profile');
    }

    public function getUsers(bool $paginate = true): Collection
    {
        $query = User::query();
        if ($paginate)
            $query = Paginator::paginate($query);

        $users = $query->get();

        return $users;
    }
}
