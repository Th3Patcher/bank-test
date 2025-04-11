<?php

namespace App\Actions\Account;

use App\Http\Resources\AccountResource;
use App\Models\User;
use App\Repositories\AccountRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

readonly class IndexAccount
{
    /**
     * @param AccountRepository $repository
     */
    public function __construct(
        private AccountRepository $repository,
    ) {}

    /**
     * @return JsonResponse
     */
    public function handle(): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();

        return response()->json([
            'data' => AccountResource::collection($this->repository->list($user)),
        ]);
    }
}
