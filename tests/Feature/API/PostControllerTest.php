<?php

namespace Tests\Feature\API;

use App\Models\Post;
use App\Models\kategoriPost;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PostControllerTest extends TestCase
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
    public function it_can_get_all_posts()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $response = $this->getJson('/api/admin/post');

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Get data posts successful',
                 ]);
    }

    /** @test */
    public function it_can_store_a_post()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $kategori = kategoriPost::factory()->create();

        $response = $this->postJson('/api/admin/post', [
            'judul' => 'Test Post',
            'tanggal' => now()->toDateString(),
            'kategori' => $kategori->id,
            'deskripsi' => 'This is a test post.',
            'tags' => ['test', 'post'],
            'komen' => 'Test comment',
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'message' => 'Post created successfully',
                 ]);
    }

    /** @test */
    public function it_cannot_store_a_post_with_invalid_data()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $response = $this->postJson('/api/admin/post', [
            // Missing required fields to trigger validation error
        ]);

        $response->assertStatus(422)
                 ->assertJson([
                     'message' => 'Validation error',
                 ]);
    }

    /** @test */
    public function it_can_get_a_post_by_kategori()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $kategori = kategoriPost::factory()->create();
        Post::factory()->create(['kategori' => $kategori->id]);

        $response = $this->getJson('/api/admin/post/' . $kategori->id . '/artikel');

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Get data post successful',
                 ]);
    }

    /** @test */
    public function it_can_edit_a_post()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $post = Post::factory()->create();

        $response = $this->getJson('/api/admin/post/edit/' . $post->id);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Get data post successful',
                 ]);
    }

    /** @test */
    public function it_can_update_a_post()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $post = Post::factory()->create();
        $kategori = kategoriPost::factory()->create();

        $response = $this->putJson('/api/admin/post/' . $post->id, [
            'judul' => 'Updated Post',
            'tanggal' => now()->toDateString(),
            'kategori' => $kategori->id,
            'deskripsi' => 'This is an updated post.',
            'tags' => ['updated', 'post'],
            'komen' => 'Updated comment',
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'message' => 'Post update successfully',
                 ]);
    }

    /** @test */
    public function it_cannot_update_a_post_with_invalid_data()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $post = Post::factory()->create();

        $response = $this->putJson('/api/admin/post/' . $post->id, [
            // Missing required fields to trigger validation error
        ]);

        $response->assertStatus(422)
                 ->assertJson([
                     'message' => 'Validation error',
                 ]);
    }

    /** @test */
    public function it_can_delete_a_post()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $post = Post::factory()->create();

        $response = $this->deleteJson('/api/admin/post/' . $post->id);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'postingan has been removed',
                 ]);
    }

    /** @test */
    public function it_cannot_delete_nonexistent_post()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $response = $this->deleteJson('/api/admin/post/999999');

        $response->assertStatus(500)
                 ->assertJson([
                     'status' => 'error',
                     'message' => 'Failed to delete postingan',
                 ]);
    }
}
