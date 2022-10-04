<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    public function test_can_registration()
    {
        $email = User::factory()
            ->make()
            ->email;

        $response = $this->postJson(
            route('registration'),
            [
                'email' => $email,
                'password' => '123456',
                'password_confirmation' => '123456'
            ]
        );

        $response->assertOk();

        $response->assertJson([
            'email' => $email,
        ]);

        $this->assertDatabaseHas(
            'users',
            [
                'email' => $email,
            ],
        );
    }

    public function test_can_login()
    {
        $password = '123456';
        $passwordHash = Hash::make($password);

        $existingUser = User::factory()
            ->create([
                'password' => $passwordHash
            ]);

        $response = $this->postJson(
            route('login'),
            [
                'email' => $existingUser->email,
                'password' => $password,
            ]
        );

        $response->assertOk();
    }
}
