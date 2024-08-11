<?php

namespace Tests\Feature\API;

use App\Models\kategoriPost;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;


class BerandaControllerTest extends TestCase
{
    // use RefreshDatabase;

    protected $adminUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->adminUser = User::factory()->create([
            'role' => 'Admin',
            'password' => Hash::make('password'),
        ]);
    }

    /** @test */
    public function user_can_access_beranda_index()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $response = $this->getJson('/api/admin/beranda');

        Log::info($response->getContent());

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Get data beranda successful',
                 ]);
    }

    /** @test */
    public function it_can_store_a_beranda()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $response = $this->postJson('/api/admin/beranda', [
            'nama' => 'test kategori',
            'slug' => 'test-kategori',
            'deskripsi' => 'test kategori',
            'type_halaman' => 'single-artikel',
    ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Add data beranda successful',
                 ]);
    }

    /** @test */
    public function it_cannot_store_a_beranda()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $response = $this->postJson('/api/admin/beranda', [
        // Missing 'nama_menu' to trigger validation error
        ]);

        $response->assertStatus(422)
                 ->assertJson([
                     'status' => 'error',
                     'message' => 'Validation error',
                 ]);
    }

    /** @test */
    public function it_can_update_beranda()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        // Create some sub-menus for testing
        $kategori = kategoriPost::create([
            'nama' => 'test kategori',
            'slug' => 'test-kategori',
            'deskripsi' => 'test kategori',
            'type_halaman' => 'multi-artikel',
        ]);

        $response = $this->putJson('/api/admin/beranda', [
            'beranda' => [$kategori->id],
        ]);

        $response->assertStatus(200)
                ->assertJson([
                    'status' => 'success',
                    'message' => 'Update data beranda successful',
                ]);
    }

    /** @test */
    public function it_cannot_update_beranda_with_invalid_data()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        // Send an invalid request (missing 'beranda')
        $response = $this->putJson('/api/admin/beranda', []);

        $response->assertStatus(422)
                ->assertJson([
                    'status' => 'error',
                    'message' => 'Validation error',
                ]);
    }

    /** @test */
    public function it_can_destroy_a_beranda()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        // Create a sub-menu for testing
        $kategori = kategoriPost::create([
            'nama' => 'test kategori',
            'slug' => 'test-kategori',
            'deskripsi' => 'test kategori',
            'type_halaman' => 'single-artikel',
        ]);

        $response = $this->deleteJson('/api/admin/beranda/' . $kategori->id);

        $response->assertStatus(200)
                ->assertJson([
                    'status' => 'success',
                    'message' => 'data beranda has been removed',
                ]);
    }

    /** @test */
    public function it_cannot_destroy_nonexistent_beranda()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        // Attempt to delete a non-existent data
        $response = $this->deleteJson('/api/admin/beranda/999999');

        $response->assertStatus(500)
                ->assertJson([
                    'status' => 'error',
                    'message' => 'Failed to delete data beranda',
                ]);
    }
}
