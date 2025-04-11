<?php

namespace App\Repositories;

use App\Models\Account;
use App\Models\User;
use Illuminate\Support\Collection;

class AccountRepository
{
    /**
     * Get list of user's account
     *
     * @param User $user
     * @return Collection
     */
    public function list(User $user): Collection
    {
        return Account::whereUserId($user->id)->get();
    }

    /**
     * Check if it is this user's account
     *
     * @param User $user
     * @param string $number
     * @return bool
     */
    public function isOwner(User $user, string $number): bool
    {
        return Account::whereUserId($user->id)->whereNumber($number)->exists();
    }
}
