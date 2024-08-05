<?php

namespace Tests\Feature\API;

use App\Models\User;
use App\Models\Menu;
use App\Models\kategoriPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class KategoriPostControllerTest extends TestCase
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
    public function user_can_access_kategori_post_index()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $response = $this->getJson('/api/admin/kategori-post');

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Get data kategori-post successful',
                 ]);
    }

    /** @test */
    public function user_can_access_kategori_post_index_kategori()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $menu = Menu::create([
            'nama_menu' => 'Test Menu',
            'hak_akses' => 1,
        ]);

        kategoriPost::create([
            'nama' => 'Test Kategori',
            'slug' => 'test-kategori',
            'index_menu' => $menu->id,
            'deskripsi' => 'Test Description',
            'type_halaman' => 'multi-artikel',
        ]);

        $response = $this->getJson('/api/admin/kategori-post/data/test-menu');

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Get data kategori-post successful',
                 ]);
    }

    /** @test */
    public function user_can_edit_kategori_post()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        // Create a kategoriPost for testing
        $kategoriPost = kategoriPost::create([
            'nama' => 'Test Kategori',
            'slug' => 'test-kategori',
            'index_menu' => 1,
            'deskripsi' => 'Test Description',
            'type_halaman' => 'multi-artikel',
        ]);

        $response = $this->getJson('/api/admin/kategori-post/edit/' . $kategoriPost->id);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Get data kategori-post id successful',
                 ]);
    }

    /** @test */
    public function it_can_store_a_kategori_post()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $response = $this->postJson('/api/admin/kategori-post', [
            'nama' => 'New Kategori',
            'slug' => 'new-kategori',
            'index_menu' => 1,
            'deskripsi' => 'Description',
            'type_halaman' => 'multi-artikel',
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Add kategori-post successful',
                 ]);
    }

    /** @test */
    public function it_cannot_store_a_kategori_post_with_invalid_data()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $response = $this->postJson('/api/admin/kategori-post', [
            // Missing required fields to trigger validation error
        ]);

        $response->assertStatus(422)
                 ->assertJson([
                     'status' => 'error',
                     'message' => 'Validation error',
                 ]);
    }

    /** @test */
    public function it_can_update_a_kategori_post()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        // Create a kategoriPost for testing
        $kategoriPost = kategoriPost::create([
            'nama' => 'Old Kategori',
            'slug' => 'old-kategori',
            'index_menu' => 1,
            'deskripsi' => 'Old Description',
            'type_halaman' => 'multi-artikel',
        ]);

        $response = $this->putJson('/api/admin/kategori-post/' . $kategoriPost->id, [
            'nama' => 'Updated Kategori',
            'slug' => 'updated-kategori',
            'index_menu' => 1,
            'deskripsi' => 'Updated Description',
            'type_halaman' => 'multi-artikel',
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Update kategori-post successful',
                 ]);

        // Assert that the kategoriPost was updated
        $this->assertDatabaseHas('kategori_posts', [
            'id' => $kategoriPost->id,
            'nama' => 'Updated Kategori',
            'slug' => 'updated-kategori',
        ]);
    }

    /** @test */
    public function it_cannot_update_a_kategori_post_with_invalid_data()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        // Create a kategoriPost for testing
        $kategoriPost = kategoriPost::create([
            'nama' => 'Old Kategori',
            'slug' => 'old-kategori',
            'index_menu' => 1,
            'deskripsi' => 'Old Description',
            'type_halaman' => 'multi-artikel',
        ]);

        $response = $this->putJson('/api/admin/kategori-post/' . $kategoriPost->id, [
            // Missing required fields to trigger validation error
        ]);

        $response->assertStatus(422)
                 ->assertJson([
                     'status' => 'error',
                     'message' => 'Validation error',
                 ]);
    }

    /** @test */
    public function it_can_destroy_a_kategori_post()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        // Create a kategoriPost for testing
        $kategoriPost = kategoriPost::create([
            'nama' => 'Kategori to Delete',
            'slug' => 'kategori-to-delete',
            'index_menu' => 1,
            'deskripsi' => 'Description',
            'type_halaman' => 'multi-artikel',
        ]);

        $response = $this->deleteJson('/api/admin/kategori-post/' . $kategoriPost->id);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'kategori-post has been removed',
                 ]);

        // Assert that the kategoriPost was deleted
        $this->assertDatabaseMissing('kategori_posts', [
            'id' => $kategoriPost->id,
        ]);
    }

    /** @test */
    public function it_cannot_destroy_nonexistent_kategori_post()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        // Attempt to delete a non-existent kategoriPost
        $response = $this->deleteJson('/api/admin/kategori-post/999999');

        $response->assertStatus(500)
                 ->assertJson([
                     'status' => 'error',
                     'message' => 'Failed to delete kategori-post',
                 ]);
    }
}
