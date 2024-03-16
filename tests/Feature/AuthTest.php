<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;


    public function test_user_can_register()
    {
        $user = User::factory()->make();

        $response = $this->postJson('/api/register', $user->toArray());

        $response->assertStatus(Response::HTTP_CREATED);

        $this->assertDatabaseHas('users', ['email' => $user->email]);
    }

    public function test_user_can_login_successfully()
    {
        createClientAccessToken();

        $user = User::factory()->create();

        $response = $this->postJson('/api/login', [...$user->only(['email']), 'password' => 'password']);

        $response->assertStatus(Response::HTTP_OK);

        $this->assertAuthenticated();
    }

    // public function test_user_can_view_own_profile()
    // {
    //     $user = User::factory()->create();

    //     Passport::actingAs($user);

    //     $response = $this->getJson('/api/profile');

    //     $response->assertStatus(200)
    //         ->assertJson([
    //             'email' => $user->email,
    //         ]);
    // }

    // public function test_user_can_view_other_user()
    // {
    //     $user = User::factory()->create();

    //     Passport::actingAs($user);

    //     $response = $this->getJson('/api/users');

    //     $response->assertStatus(200)
    //         ->assertJson([
    //             'email' => $user->email,
    //         ]);
    // }

    // public function test_user_can_update_own_profile()
    // {
    //     $user = User::factory()->create();

    //     Passport::actingAs($user);

    //     $updateData = [
    //         'name' => $this->faker->name,
    //         'email' => $this->faker->unique()->safeEmail,
    //         'password' => 'password',
    //     ];

    //     $response = $this->putJson('/api/users', $updateData);

    //     $response->assertStatus(200)
    //         ->assertJson($updateData);

    //     $this->assertDatabaseHas('users', $updateData);
    // }

    // public function test_user_can_delete_own_account()
    // {
    //     $user = User::factory()->create();

    //     Passport::actingAs($user);

    //     $response = $this->deleteJson('/api/users');

    //     $response->assertStatus(204);

    //     $this->assertDeleted($user);
    // }
}

