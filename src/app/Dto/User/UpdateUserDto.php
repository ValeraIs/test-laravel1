<?php

namespace App\Dto\User;

use App\Enums\Lang;

final class UpdateUserDto
{
    public function __construct(
        public readonly Lang   $lang,
        public readonly string $timezone,
    ) {}

    public static function create(array $data): self
    {
        return new UpdateUserDto(
            lang: Lang::from($data['lang']),
            timezone: $data['timezone']
        );
    }
}
