<?php

namespace App\Http\Controllers\Auth;

use App\DTO\Auth\LoginData;
use App\Helpers\Common\JResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $data = new LoginData($request->validated());
        $response = $this->authService->login($data);
        return JResponse::success($response);
    }

    public function logout(): JsonResponse
    {
        $this->authService->logout();
        return JResponse::success('Successfully logged out');
    }

    public function refresh(): JsonResponse
    {
        $response = $this->authService->refresh();
        return JResponse::success($response);
    }
}
