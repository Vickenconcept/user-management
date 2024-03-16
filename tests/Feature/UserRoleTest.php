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


    public function test_admin_can_delete_user()
    {

        $admin = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        Passport::actingAs($admin);

        $userToDelete = User::factory()->create();

        $response = $this->deleteJson('/api/users/' . $userToDelete->id);

        $response->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseMissing('users', [
            'id' => $userToDelete->id,
        ]);
    }

    public function test_user_cannot_delete_user()
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        Passport::actingAs($user);

        $userToDelete = User::factory()->create();

        $response = $this->deleteJson('/api/users/' . $userToDelete->id);

        $response->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertDatabaseHas('users', [
            'id' => $userToDelete->id,
        ]);
    }


    public function test_user_can_view_own_profile()
    {
        $user = User::factory()->create();

        Passport::actingAs($user);

        $response = $this->getJson('/api/profile');

        $response->assertStatus(200);

    }

    public function test_admin_can_view_all_users()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        Passport::actingAs($admin);

        $users = User::factory()->count(3)->create();

        $response = $this->getJson('/api/users');

        $response->assertStatus(200);

    }

    public function test_non_admin_cannot_view_all_users()
    {
        $user = User::factory()->create(['role' => 'user']);

        Passport::actingAs($user);

        $response = $this->getJson('/api/users');

        $response->assertStatus(403);
    }
}

