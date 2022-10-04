<?php

namespace App\Repositories;

use App\Models\User;

final class UserRepository
{
    public function getOneByEmail(string $email): ?User
    {
        return User::where('email', $email)
            ->first();
    }
}
