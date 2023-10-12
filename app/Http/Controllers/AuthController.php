<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(
        private readonly UserService $userService
    )
    {
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        if (!Auth::attempt($request->validated())) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return response()->json([
            'access_token' => $this->userService->generateTokenByEmail($request->email),
            'token_type' => 'Bearer',
        ]);
    }
}
