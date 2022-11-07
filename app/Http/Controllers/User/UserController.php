<?php

namespace App\Http\Controllers\User;

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
        $response = $user->with('profile')->get();
        return JResponse::success($response);
    }

    public function getUsers(): JsonResponse
    {
        $response = $this->userService->getUsers();
        return JResponse::success($response);
    }

    public function getMe(): JsonResponse
    {
        $response = Auth::user()->with('profile')->get();
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
        $data = new UpdateUserProfileData($request->validated());
        $this->userService->updateUserProfile(Auth::user(), $data);
        return JResponse::success();
    }
}
