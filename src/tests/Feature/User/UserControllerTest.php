<?php

namespace Tests\Feature\User;

use App\Models\User;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function test_can_update_an_user()
    {
        $existingUser = User::factory()
            ->create();

        $newUser = User::factory()
            ->make();

        $response = $this->actingAs($existingUser, 'sanctum')
            ->putJson(
            route('user.update'),
            $newUser->toArray()
        );

        $response->assertOk();

        $response->assertJson([
            'lang' => $newUser->lang->value,
            'timezone' => $newUser->timezone,
        ]);

        $this->assertDatabaseHas(
            'users',
            [
                'email' => $existingUser->email,
                'lang' => $newUser->lang->value,
                'timezone' => $newUser->timezone,
            ],
        );
    }
}
