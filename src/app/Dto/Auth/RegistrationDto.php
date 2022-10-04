<?php

namespace App\Dto\Auth;

final class RegistrationDto
{
    public function __construct(
        public readonly string $email,
        public readonly string $password,
    ) {}

    public static function create(array $data): self
    {
        return new self(
            email: $data['email'],
            password: $data['password'],
        );
    }
}
