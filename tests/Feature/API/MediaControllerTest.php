<?php
namespace Tests\Feature\API;

use App\Models\Media;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MediaControllerTest extends TestCase
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
    public function user_can_access_media_index()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $response = $this->getJson('/api/admin/media');

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Get data media successful',
                 ]);
    }

    /** @test */
    public function it_can_store_media()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        Storage::fake('public');

        $file = UploadedFile::fake()->image('media.jpg');

        $response = $this->postJson('/api/admin/media', [
            'media' => $file,
            'kategori' => 'image',
            'keterangan' => 'Test Media',
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Add media successful',
                 ]);
    }

    /** @test */
    public function it_cannot_store_media_with_invalid_data()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $response = $this->postJson('/api/admin/media', [
            // Missing required fields to trigger validation error
        ]);

        $response->assertStatus(422)
                 ->assertJson([
                     'status' => 'error',
                     'message' => 'Validation error',
                 ]);
    }

    /** @test */
    public function it_can_upload_media_to_ckeditor()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        Storage::fake('public');

        $file = UploadedFile::fake()->image('media.jpg');

        $response = $this->postJson('/api/admin/media/ckeditor', [
            'upload' => $file,
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'url',
                 ]);
    }

    /** @test */
    public function it_cannot_upload_media_to_ckeditor_with_invalid_data()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $response = $this->postJson('/api/admin/media/ckeditor', [
            // Missing required fields to trigger validation error
        ]);

        $response->assertStatus(422)
                 ->assertJson([
                     'status' => 'error',
                     'message' => 'Validation error',
                 ]);
    }

    /** @test */
    public function it_can_destroy_media()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        Storage::fake('public');

        $file = UploadedFile::fake()->image('media.jpg');

        $media = Media::create([
            'media' => $file->hashName(),
            'kategori' => 'image',
            'keterangan' => 'Test Media',
        ]);

        $response = $this->deleteJson('/api/admin/media/' . $media->id);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'media has been removed',
                 ]);
    }

    /** @test */
    public function it_cannot_destroy_nonexistent_media()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $response = $this->deleteJson('/api/admin/media/999999');

        $response->assertStatus(500)
                 ->assertJson([
                     'status' => 'error',
                     'message' => 'Failed to delete media',
                 ]);
    }

    /** @test */
    public function it_can_destroy_media_from_storage()
    {
        $this->actingAs($this->adminUser, 'sanctum');
        
        $file = UploadedFile::fake()->image('media.jpg');
        $storedFileName = uniqid('media_') . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('media/ckeditor'), $storedFileName);

        echo($storedFileName);
    
        $response = $this->deleteJson('/api/admin/media-name/' . $storedFileName);
    
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'media has been removed',
                 ]);
    }
        
    /** @test */
    public function it_cannot_destroy_nonexistent_media_from_storage()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $response = $this->deleteJson('/api/admin/media-name/nonexistent.jpg');

        $response->assertStatus(404)
                ->assertJson([
                    'status' => 'error',
                    'message' => 'Media not found',
                ]);
    }
}
