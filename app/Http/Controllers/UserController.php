<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        private readonly UserService $userService
    )
    {
    }

    public function index()
    {
        return UserResource::collection(
            User::all()
        );
    }

    /**
     * @param UserRequest $request
     * @return UserResource
     */
    public function store(UserRequest $request): UserResource
    {
        return UserResource::make(
            $this->userService->register(
                $request->validated() + ['avatar' => $request->file('avatar')]
            )
        );
    }
}
