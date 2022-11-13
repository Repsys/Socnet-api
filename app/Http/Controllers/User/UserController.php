<?php

namespace App\Http\Controllers\User;

use App\DTO\CountryAndCityData;
use App\DTO\User\CreateUserData;
use App\DTO\User\Profile\UpdateUserProfileData;
use App\DTO\User\UpdateUserData;
use App\Helpers\Common\JResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserProfileRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Paginator;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function createUser(CreateUserRequest $request): JsonResponse
    {
        $data = new CreateUserData($request->validated());
        $response = $this->userService->createUser($data);
        return JResponse::success($response);
    }

    public function getUser(User $user): JsonResponse
    {
        $response = $this->userService->getUser($user);
        return JResponse::success($response);
    }

    public function getUsers(): JsonResponse
    {
        $response = $this->userService->getUsers();
        return JResponse::success(Paginator::assignParams($response));
    }

    public function getMe(): JsonResponse
    {
        $response = $this->userService->getUser(Auth::user());
        return JResponse::success($response);
    }

    public function updateMe(UpdateUserRequest $request): JsonResponse
    {
        $data = new UpdateUserData($request->validated());
        $this->userService->updateUser(Auth::user(), $data);
        return JResponse::success();
    }

    public function updateMyProfile(UpdateUserProfileRequest $request): JsonResponse
    {
        $profileData = new UpdateUserProfileData($request->validated());
        $countryData = new CountryAndCityData($request->validated());
        $this->userService->updateUserProfile(Auth::user(), $profileData, $countryData);
        return JResponse::success();
    }
}
