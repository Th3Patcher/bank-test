<?php

namespace App\Http\Controllers;

use App\Actions\Auth\LoginUser;
use App\Actions\Auth\RegisterUser;
use App\DTOs\Auth\LoginDTO;
use App\DTOs\Auth\RegisterDTO;
use App\Exceptions\DomainException;
use App\Http\Requests\AuthRequests\LoginRequest;
use App\Http\Requests\AuthRequests\RegisterRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * @throws DomainException
     */
    public function register(RegisterRequest $request, RegisterUser $action): JsonResponse
    {
        return $action->handle(RegisterDTO::fromArray($request->validated()));
    }

    /**
     * @throws ValidationException
     */
    public function login(LoginRequest $request, LoginUser $action): JsonResponse
    {
        return $action->handle(LoginDTO::fromArray($request->validated()));
    }
}
