<?php

namespace App\Repositories;

use App\DTOs\Auth\RegisterDTO;
use App\Models\User;

class UserRepository
{
    /**
     * Create user
     *
     * @param RegisterDTO $data
     * @return User
     */
    public function create(RegisterDTO $data): User
    {
        return User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => $data->password,
        ]);
    }
}
