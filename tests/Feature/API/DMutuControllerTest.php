<?php

namespace Tests\Feature\API;

use App\Models\DMutu;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class DMutuControllerTest extends TestCase
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
    public function user_can_access_DMutu_index()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        DMutu::factory()->count(3)->create();

        $response = $this->getJson('/api/admin/dokumen-mutu');

        Log::info($response->getContent());

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Get data dokumen mutu successful',
                 ]);
    }
    
    /** @test */
    public function user_cannot_access_DMutu_index()
    {
        $response = $this->getJson('/api/admin/dokumen-mutu');
        
        Log::info($response->getContent());

        $response->assertStatus(401); // Unauthorized
    }

    /** @test */
    public function user_can_store_a_DMutu()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $response = $this->postJson('/api/admin/dokumen-mutu', [
            'nama_Dmutu' => 'Dokumen Test',
            'keterangan' => 'Ini adalah Keterangan Dokumen.',
            'file_Dmutu' => null,
        ]);

        Log::info($response->getContent());

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Add dokumen mutu successful',
                 ]);
    }

    /** @test */
    public function user_cannot_store_a_DMutu()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $response = $this->postJson('/api/admin/dokumen-mutu', [
            'nama_Dmutu' => '',
            'keterangan' => '',
            'file_Dmutu' => null,
        ]);

        Log::info($response->getContent());

        $response->assertStatus(422) // Unprocessable Entity
                 ->assertJsonValidationErrors(['nama_Dmutu']);
    }

    /** @test */
    public function user_can_view_a_DMutu()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $file = UploadedFile::fake()->create('file_dmutu.pdf');
        $file->move(public_path('files/dmutu'), 'file_dmutu.pdf');

        $dMutu = DMutu::factory()->create([
            'file_Dmutu' => 'file_dmutu.pdf',
        ]);

        $response = $this->getJson('/api/dokumen-mutu/' . $dMutu->Dmutu_id .'/view');

        Log::info($response->getContent());

        $response->assertStatus(200);
    }
    
    /** @test */
    public function user_can_download_a_DMutu()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $file = UploadedFile::fake()->create('file_dmutu.pdf');
        $file->move(public_path('files/dmutu'), 'file_dmutu.pdf');

        $dMutu = DMutu::factory()->create([
            'file_Dmutu' => 'file_dmutu.pdf',
        ]);

        $response = $this->getJson('/api/dokumen-mutu/' . $dMutu->Dmutu_id . '/download');

        Log::info($response->getContent());

        $response->assertStatus(200);
    }
    
    /** @test */
    public function user_can_delete_a_DMutu()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $dMutu = DMutu::factory()->create();

        $response = $this->deleteJson('/api/admin/dokumen-mutu/' . $dMutu->Dmutu_id);

        Log::info($response->getContent());

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Dokumen mutu has been removed',
                 ]);
    }

    /** @test */
    public function user_cannot_delete_a_DMutu()
    {
        $dMutu = DMutu::factory()->create();

        $response = $this->deleteJson('/api/admin/dokumen-mutu/' . $dMutu->Dmutu_id);

        Log::info($response->getContent());

        $response->assertStatus(401); // Unauthorized
    }
}
