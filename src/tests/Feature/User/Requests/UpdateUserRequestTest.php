<?php

namespace Tests\Feature\User\Requests;

use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class UpdateUserRequestTest extends TestCase
{
    use WithoutMiddleware;

    private string $routePrefix = 'user.';

    public function test_timezone_param()
    {
        $validatedField = 'timezone';

        $existingUser = User::factory()
            ->create();

        $newUser = User::factory()->make([
            $validatedField => 'wrong timezone'
        ]);

        $this->actingAs($existingUser, 'sanctum')
            ->putJson(
                route($this->routePrefix . 'update'),
                $newUser->toArray()
            )->assertJsonValidationErrors($validatedField);

        $newUser = User::factory()->make([
            $validatedField => null
        ]);

        $this->actingAs($existingUser, 'sanctum')
            ->putJson(
                route($this->routePrefix . 'update'),
                $newUser->toArray()
            )->assertJsonValidationErrors($validatedField);

        $newUser = User::factory()
            ->make();

        $this->actingAs($existingUser, 'sanctum')
            ->putJson(
                route($this->routePrefix . 'update'),
                $newUser->toArray()
            )->assertJsonMissingValidationErrors($validatedField);
    }

    public function test_lang_param()
    {
        $validatedField = 'lang';

        $existingUser = User::factory()
            ->create();

        $newUser = User::factory()
            ->make();

        $this->actingAs($existingUser, 'sanctum')
            ->putJson(
                route($this->routePrefix . 'update'),
                [
                    'lang' => 'wrong lang',
                    'timezone' => $newUser->timezone
                ]
            )->assertJsonValidationErrors($validatedField);

        $newUser = User::factory()->make([
            $validatedField => null
        ]);

        $this->actingAs($existingUser, 'sanctum')
            ->putJson(
                route($this->routePrefix . 'update'),
                $newUser->toArray()
            )->assertJsonValidationErrors($validatedField);

        $newUser = User::factory()
            ->make();

        $this->actingAs($existingUser, 'sanctum')
            ->putJson(
                route($this->routePrefix . 'update'),
                $newUser->toArray()
            )->assertJsonMissingValidationErrors($validatedField);
    }
}
