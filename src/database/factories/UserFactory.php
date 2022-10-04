<?php

namespace Database\Factories;

use App\Enums\Lang;
use DateTimeZone;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('test123321'),
            'timezone' => fake()->randomElement(DateTimeZone::listIdentifiers()),
            'lang' => fake()->randomElement(Lang::cases())
        ];
    }
}
