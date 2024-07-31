<?php

namespace Tests\Feature\API;

use App\Models\User;
use App\Models\SubMenu;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
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
                     'message' => 'Get data sub-menu successful',
                 ]);
    }

    /** @test */
    public function it_can_store_a_beranda()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $response = $this->postJson('/api/admin/beranda', [
            'nama_menu' => 'Test Menu',
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Add sub-menu successful',
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
        $subMenu1 = SubMenu::create(['nama_menu' => 'Menu 1', 'kategori' => 'beranda', 'beranda' => 0]);

        $response = $this->putJson('/api/admin/beranda', [
            'beranda' => [$subMenu1->id],
        ]);

        $response->assertStatus(200)
                ->assertJson([
                    'status' => 'success',
                    'message' => 'Update sub-menu successful',
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
        $subMenu = SubMenu::create(['nama_menu' => 'Menu to Delete', 'kategori' => 'beranda', 'beranda' => 1]);

        $response = $this->deleteJson('/api/admin/beranda/' . $subMenu->id);

        $response->assertStatus(200)
                ->assertJson([
                    'status' => 'success',
                    'message' => 'sub-menu beranda has been removed',
                ]);
    }

    /** @test */
    public function it_cannot_destroy_nonexistent_beranda()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        // Attempt to delete a non-existent sub-menu
        $response = $this->deleteJson('/api/admin/beranda/999999');

        $response->assertStatus(500)
                ->assertJson([
                    'status' => 'error',
                    'message' => 'Failed to delete sub-menu beranda',
                ]);
    }
}
