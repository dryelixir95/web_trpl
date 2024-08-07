<?php

namespace Tests\Feature\API;

use App\Models\Media;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class SettingControllerTest extends TestCase
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
    public function it_can_get_settings()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $response = $this->getJson('/api/admin/setting');

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Get data setting successful',
                 ]);
    }

    /** @test */
    public function it_can_store_a_setting()
    {
        $response = $this->actingAs($this->adminUser, 'sanctum')->postJson('/api/admin/setting', [
            'name' => 'site_description',
            'value' => 'A description of my site',
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Setting saved successfully',
                     'setting' => [
                         'name' => 'site_description',
                         'value' => 'A description of my site'
                     ],
                 ]);

        $this->assertDatabaseHas('settings', [
            'name' => 'site_description',
            'value' => 'A description of my site',
        ]);
    }
}
