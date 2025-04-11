<?php

namespace App\Actions\Auth;

use App\DTOs\Auth\LoginDTO;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginUser
{
    /**
     * @throws ValidationException
     */
    public function handle(LoginDTO $data): JsonResponse
    {
        $user = User::firstWhere('email', $data->email);

        if (! Hash::check($data->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Email or password are invalid.'],
            ]);
        }

        //Clear previous tokens
        $user->tokens()->delete();

        $token = $user->createToken('auth_token', expiresAt: now()->addMinutes(config('sanctum.expiration')))->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
            'message' => 'Login successful',
        ]);
    }
}
