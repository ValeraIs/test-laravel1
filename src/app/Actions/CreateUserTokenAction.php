<?php

namespace App\Actions;

use App\Dto\Auth\LoginDto;
use App\Repositories\UserRepository;

final class CreateUserTokenAction
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {}

    public function execute(LoginDto $loginDto): string
    {
        $user = $this->userRepository->getOneByEmail($loginDto->email);

        return $user->createToken("API TOKEN")
            ->plainTextToken;
    }
}
