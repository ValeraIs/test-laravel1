<?php

namespace App\Actions;

use App\Dto\Auth\RegistrationDto;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

final class CreateUserAction
{
    public function execute(RegistrationDto $registrationDto): User
    {
        return User::create([
            'email' => $registrationDto->email,
            'password' => Hash::make($registrationDto->password)
        ]);
    }
}
