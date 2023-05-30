<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\UserService;
use Exception;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(private readonly UserService $userService)
    {
    }

    /**
     * @throws Exception
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->userService->register($request->validated());
        return $user->response()->setStatusCode(201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $token = $this->userService->login($request->validated());
        return response()->json(['token' => $token]);
    }
}
