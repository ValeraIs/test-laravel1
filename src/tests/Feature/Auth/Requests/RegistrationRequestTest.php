<?php

namespace Tests\Feature\Auth\Requests;

use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class RegistrationRequestTest extends TestCase
{
    use WithoutMiddleware;

    public function test_email_param()
    {
        $validatedField = 'email';

        $newUser = User::factory()->make([
            $validatedField => 'wrong email'
        ]);

        $this->postJson(
            route('registration'),
            $newUser->toArray()
        )->assertJsonValidationErrors($validatedField);

        $newUser = User::factory()->make([
            $validatedField => null
        ]);

        $this->postJson(
            route('registration'),
            $newUser->toArray()
        )->assertJsonValidationErrors($validatedField);

        $newUser = User::factory()
            ->make();

        $this->postJson(
            route('registration'),
            $newUser->toArray()
        )->assertJsonMissingValidationErrors($validatedField);
    }

    public function test_password_param()
    {
        $validatedField = 'password';

        $email = User::factory()
            ->make()
            ->email;

        $this->postJson(
            route('registration'),
            [
                'email' => $email,
                $validatedField => 'a',
                'password_confirmation' => 'a'
            ]
        )->assertJsonValidationErrors($validatedField);

        $this->postJson(
            route('registration'),
            [
                'email' => $email,
                $validatedField => null,
            ]
        )->assertJsonValidationErrors($validatedField);

        $this->postJson(
            route('registration'),
            [
                'email' => $email,
                $validatedField => '123456',
                'password_confirmation' => '123456'
            ]
        )->assertJsonMissingValidationErrors($validatedField);
    }

    public function test_password_confirmation_param()
    {
        $validatedField = 'password_confirmation';

        $email = User::factory()
            ->make()
            ->email;

        $this->postJson(
            route('registration'),
            [
                'email' => $email,
                'password' => '123456',
                $validatedField => 'test'
            ]
        )->assertJsonValidationErrors('password');

        $this->postJson(
            route('registration'),
            [
                'email' => $email,
                'password' => '123456',
                $validatedField => '123456'
            ]
        )->assertJsonMissingValidationErrors('password');
    }
}
