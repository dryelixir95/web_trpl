<?php

namespace Tests\Feature\API;

use App\Models\User;
use App\Models\Akreditasi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class AkreditasiControllerTest extends TestCase
{
    use RefreshDatabase;

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
    public function user_can_access_akreditasi_index()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        Akreditasi::factory()->create();

        $response = $this->getJson('/api/admin/akreditasi');

        Log::info($response->getContent());

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Get data akreditasi successful',
                 ]);
    }

    /** @test */
    public function user_cannot_access_akreditasi_index()
    {
        $response = $this->getJson('/api/admin/akreditasi');
        
        Log::info($response->getContent());

        $response->assertStatus(401); // Unauthorized
    }

    /** @test */
    public function user_can_store_akreditasi()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $response = $this->postJson('/api/admin/akreditasi', [
            'judul' => 'Akreditasi Test',
            'tgl_akreditasi' => '2024-01-01',
            'file_akreditasi' => null,
        ]);

        Log::info($response->getContent());

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Add akreditasi successful',
                 ]);
    }

    /** @test */
    public function user_cannot_store_akreditasi()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $response = $this->postJson('/api/admin/akreditasi', [
            'judul' => '', // Judul tidak boleh kosong
            'tgl_akreditasi' => 'invalid-date', // Tanggal tidak valid
            'file_akreditasi' => null,
        ]);

        Log::info($response->getContent());

        $response->assertStatus(422) // Unprocessable Entity
                 ->assertJsonValidationErrors(['judul', 'tgl_akreditasi']);
    }

    /** @test */
    public function user_can_update_an_akreditasi()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        Akreditasi::factory()->create();

        $data = [
            'judul' => 'Updated Akreditasi',
            'tgl_akreditasi' => '2023-06-02',
            'file_akreditasi' => UploadedFile::fake()->image('new_akreditasi.jpg'),
        ];

        $response = $this->putJson('/api/admin/akreditasi', $data);

        Log::info($response->getContent());

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Update akreditasi successful',
                 ]);
    }

    /** @test */
    public function user_cannot_update_an_akreditasi()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        Akreditasi::factory()->create();

        $data = [
            'judul' => '', // Judul tidak boleh kosong
            'tgl_akreditasi' => 'invalid-date', // Tanggal tidak valid
            'file_akreditasi' => UploadedFile::fake()->image('new_akreditasi.jpg'),
        ];

        $response = $this->putJson('/api/admin/akreditasi', $data);

        Log::info($response->getContent());

        $response->assertStatus(422) // Unprocessable Entity
                 ->assertJsonValidationErrors(['judul', 'tgl_akreditasi']);
    }
}
