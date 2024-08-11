<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User;

class UserControllerTest extends TestCase
{
    private $adminUser;

    protected function setUp(): void
    {
        parent::setUp();

        // Create an admin user for authentication
        $this->adminUser = User::factory()->create([
            'role' => 'Admin',
            'password' => Hash::make('password')
        ]);
    }

    /** @test */
    public function it_can_get_all_users()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $response = $this->getJson('/api/admin/user');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'message',
                     'users' => [
                         '*' => ['id', 'name', 'email', 'role', 'created_at', 'updated_at']
                     ],
                     'url'
                 ]);
    }

    /** @test */
    public function it_can_store_a_user()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $response = $this->postJson('/api/admin/user', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'User'
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Add user successful'
                 ]);
    }

    /** @test */
    public function it_cannot_store_a_user_with_invalid_data()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $response = $this->postJson('/api/admin/user', [
            'name' => 'John Doe',
            'email' => 'invalid-email',
            'password' => 'short',
            'password_confirmation' => 'different',
            'role' => 'User'
        ]);

        $response->assertStatus(422)
                 ->assertJson([
                     'status' => 'error',
                     'message' => 'Validation error'
                 ]);
    }

    /** @test */
    public function it_can_get_a_user_by_id()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $user = User::factory()->create();

        $response = $this->getJson("/api/admin/user/edit/{$user->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Get user successful',
                     'user' => [
                         'id' => $user->id,
                         'name' => $user->name,
                         'email' => $user->email,
                         'role' => $user->role,
                     ],
                 ]);
    }

    /** @test */
    public function it_can_update_a_user()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $user = User::factory()->create();

        $response = $this->putJson("/api/admin/user/{$user->id}", [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword',
            'role' => 'User'
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Edit user successful'
                 ]);

        $user->refresh();
        $this->assertEquals('Updated Name', $user->name);
        $this->assertEquals('updated@example.com', $user->email);
    }

    /** @test */
    public function it_cannot_update_a_user_with_invalid_data()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $user = User::factory()->create();

        $response = $this->putJson("/api/admin/user/{$user->id}", [
            'name' => 'Updated Name',
            'email' => 'invalid-email',
            'password' => 'short',
            'password_confirmation' => 'different',
            'role' => 'User'
        ]);

        $response->assertStatus(422)
                 ->assertJson([
                     'status' => 'error',
                     'message' => 'Validation error'
                 ]);
    }

    /** @test */
    public function it_can_delete_a_user()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $user = User::factory()->create();

        $response = $this->deleteJson("/api/admin/user/{$user->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'User has been removed'
                 ]);

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    /** @test */
    public function it_cannot_delete_a_nonexistent_user()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $response = $this->deleteJson('/api/admin/user/999');

        $response->assertStatus(500)
                 ->assertJson([
                     'status' => 'error',
                     'message' => 'Failed to remove user'
                 ]);
    }
}
