<?php

namespace Tests\Feature\API;

use App\Models\Berita;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class BeritaControllerTest extends TestCase
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
    public function user_can_access_berita_index()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        Berita::factory()->count(3)->create();

        $response = $this->getJson('/api/admin/berita');

        Log::info($response->getContent());

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Get data berita successful',
                 ]);
    }
    
    /** @test */
    public function user_cannot_access_berita_index()
    {
        $response = $this->getJson('/api/admin/berita');
        
        Log::info($response->getContent());

        $response->assertStatus(401); // Unauthorized
    }

    /** @test */
    public function user_can_store_a_berita()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $response = $this->postJson('/api/admin/berita', [
            'judul_berita' => 'Berita Test',
            'isi_berita' => 'Ini adalah isi berita.',
            'tgl_berita' => '2024-01-01',
            'gambar' => null,
        ]);

        Log::info($response->getContent());

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Add berita successful',
                 ]);
    }

    /** @test */
    public function user_cannot_store_a_berita()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $response = $this->postJson('/api/admin/berita', [
            'judul_berita' => '',
            'isi_berita' => '',
            'tgl_berita' => 'invalid-date',
        ]);

        Log::info($response->getContent());

        $response->assertStatus(422) // Unprocessable Entity
                 ->assertJsonValidationErrors(['judul_berita', 'isi_berita', 'tgl_berita']);
    }

    /** @test */
    public function user_can_show_a_berita()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $berita = Berita::factory()->create();

        $response = $this->postJson('/api/logout');

        $response = $this->getJson('/api/berita/' . $berita->berita_id);

        Log::info($response->getContent());

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Get berita successful',
                 ]);
    }

    /** @test */
    public function user_can_update_a_berita()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $berita = Berita::factory()->create();

        $data = [
            'judul_berita' => 'Updated Berita',
            'isi_berita' => 'Updated isi berita.',
            'tgl_berita' => '2023-06-02',
            'gambar' => UploadedFile::fake()->image('new_berita.jpg'),
        ];

        $response = $this->putJson('/api/admin/berita/' . $berita->berita_id, $data);

        Log::info($response->getContent());

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Update berita successful',
                 ]);
    }

    /** @test */
    public function user_cannot_update_a_berita()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $berita = Berita::factory()->create();

        $response = $this->putJson('/api/admin/berita/' . $berita->berita_id, [
            'judul_berita' => '',
            'isi_berita' => '',
            'tgl_berita' => 'invalid-date',
        ]);

        Log::info($response->getContent());

        $response->assertStatus(422) // Unprocessable Entity
                    ->assertJsonValidationErrors(['judul_berita', 'isi_berita', 'tgl_berita']);
    }
    
    /** @test */
    public function user_can_delete_a_berita()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $berita = Berita::factory()->create();

        $response = $this->deleteJson('/api/admin/berita/' . $berita->berita_id);

        Log::info($response->getContent());

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Berita has been removed',
                 ]);
    }

    /** @test */
    public function user_cannot_delete_a_berita()
    {
        $berita = Berita::factory()->create();

        $response = $this->deleteJson('/api/admin/berita/' . $berita->berita_id);

        Log::info($response->getContent());

        $response->assertStatus(401); // Unauthorized
    }
}
