<?php

namespace App\Actions\Account;

use App\Http\Resources\AccountResource;
use App\Models\Account;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StoreAccount
{
    /**
     * @param string $code
     * @return JsonResponse
     */
    public function handle(string $code): JsonResponse
    {
        $account = Account::create([
            'user_id' => Auth::user()->id,
            'number' => Str::of(Str::random(5).(mt_rand(10, 100) ** mt_rand(3, 8)))->upper()->take(15)->value(),
            'currency' => Str::of($code)->lower(),
        ]);

        return response()->json([
            'message' => 'Account created successfully.',
            'data' => new AccountResource($account),
        ]);
    }
}
