<?php

namespace App\Services\Auth;

use App\DTO\Auth\LoginData;
use App\Exceptions\BusinessErrorException;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthService
{
    public function login(LoginData $data): array
    {
        if (!$token = Auth::attempt($data->getCredentials())) {
            throw new BusinessErrorException('Wrong login or password.', [], Response::HTTP_UNAUTHORIZED);
        }

        return $this->getTokenData($token);
    }

    public function logout(): void
    {
        Auth::logout();
    }

    public function refresh(): array
    {
        return $this->getTokenData(Auth::refresh());
    }

    public function getTokenData($token): array
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ];
    }
}
