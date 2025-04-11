<?php

namespace App\Actions\Auth;

use App\DTOs\Auth\RegisterDTO;
use App\Exceptions\AuthExceptions\DomainException;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Throwable;

readonly class RegisterUser
{
    /**
     * @param UserRepository $repository
     */
    public function __construct(
        private UserRepository $repository
    ) {}

    /**
     * @throws DomainException
     */
    public function handle(RegisterDTO $data): JsonResponse
    {
        DB::beginTransaction();

        try {
            $user = $this->repository->create($data);
            $token = $user->createToken($user->email, expiresAt: now()->addMinutes(config('sanctum.expiration')))->plainTextToken;
        } catch (Throwable) {
            DB::rollBack();

            throw new DomainException('Something went wrong. Please try again later.', 500, 'auth');
        }
        DB::commit();

        return response()->json(compact('user', 'token'));
    }
}
