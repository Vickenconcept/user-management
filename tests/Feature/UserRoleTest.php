<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UserRoleTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    // public $user;

    // public function setUp() : void {
    //    $this->user = User::factory()->create(); 
    // }


    public function test_Admin_can_delete_user()
    {
        
        $user = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'role' => 'admin',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->postJson('/api/register', $user);

        $response->assertStatus(201);


        $loginData = [
            'email' => $user['email'],
            'password' => 'password',
        ];

        $response = $this->postJson('/api/login', $loginData);

        Passport::actingAs($loginData);

        $response->assertStatus(204);
     
        // $response = $this->deleteJson('/api/users/'.$this->user->id);
        


        // $response->assertStatus(204);

        // $this->assertDeleted($user);
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
