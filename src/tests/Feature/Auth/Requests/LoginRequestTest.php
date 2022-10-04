<?php

namespace Tests\Feature\Auth\Requests;

use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginRequestTest extends TestCase
{
    use WithoutMiddleware;

    public function test_email_param()
    {
        $validatedField = 'email';

        $password = '123456';
        $passwordHash = Hash::make($password);

        $existingUser = User::factory()
            ->create([
                'password' => $passwordHash
            ]);

        $this->postJson(
            route('login'),
            [
                'email' => 'wrong email',
                'password' => '123456'
            ]
        )->assertJsonValidationErrors($validatedField);

        $this->postJson(
            route('login'),
            [
                'email' => null,
                'password' => '123456'
            ]
        )->assertJsonValidationErrors($validatedField);

        $newUser = User::factory()
            ->make();

        $this->postJson(
            route('login'),
            [
                'email' => $newUser->email,
                'password' => '123456'
            ]
        )->assertJsonValidationErrors($validatedField);

        $this->postJson(
            route('login'),
            [
                'email' => $existingUser->email,
                'password' => $password
            ]
        )->assertJsonMissingValidationErrors();
    }

    public function test_password_param()
    {
        $validatedField = 'password';

        $password = '123456';
        $passwordHash = Hash::make($password);

        $existingUser = User::factory()
            ->create([
                $validatedField => $passwordHash
            ]);

        $this->postJson(
            route('login'),
            [
                'email' => $existingUser->email,
                $validatedField => 'wrong password'
            ]
        )->assertJsonValidationErrors('email');

        $this->postJson(
            route('login'),
            [
                'email' => $existingUser->email,
                $validatedField => null
            ]
        )->assertJsonValidationErrors($validatedField);

        $this->postJson(
            route('login'),
            [
                'email' => $existingUser->email,
                $validatedField => $password
            ]
        )->assertJsonMissingValidationErrors();
    }
}
