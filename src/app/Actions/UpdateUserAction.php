<?php

namespace App\Actions;

use App\Dto\User\UpdateUserDto;
use App\Models\User;

final class UpdateUserAction
{
    public function execute(User $user, UpdateUserDto $updateUserDto): User
    {
        $user->lang = $updateUserDto->lang;
        $user->timezone = $updateUserDto->timezone;

        $user->save();

        return $user;
    }
}
