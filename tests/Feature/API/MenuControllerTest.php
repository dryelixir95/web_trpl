<?php

namespace Tests\Feature\API;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class MenuControllerTest extends TestCase
{
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
    public function user_can_access_menu_index()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $response = $this->getJson('/api/admin/menu');

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Get data menu successful',
                 ]);
    }

    /** @test */
    public function it_can_store_a_menu()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $response = $this->postJson('/api/admin/menu', [
            'nama_menu' => 'Tes Menu',
            'hak_akses' => ['Admin'],
]);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Add menu successful',
                 ]);
    }

    /** @test */
    public function it_cannot_store_a_menu()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $response = $this->postJson('/api/admin/menu', [
        // Missing 'nama_menu' to trigger validation error
        ]);

        $response->assertStatus(422)
                 ->assertJson([
                     'status' => 'error',
                     'message' => 'Validation error',
                 ]);
    }

    /** @test */
    public function it_can_update_menu()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $menu = Menu::create([
            'nama_menu' => 'Tes Menu',
            'hak_akses' => 1,
        ]);

        $response = $this->putJson('/api/admin/menu/'.$menu->id, [
            'nama_menu' => 'Tes Menu baru',
            'hak_akses' => ['Admin'],
        ]);

        $response->assertStatus(200)
                ->assertJson([
                    'status' => 'success',
                    'message' => 'Add menu successful',
                ]);
    }

    /** @test */
    public function it_cannot_update_menu_with_invalid_data()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $menu = Menu::create([
            'nama_menu' => 'Tes Menu',
            'hak_akses' => 1,
        ]);

        $response = $this->putJson('/api/admin/menu/'.$menu->id, []);

        $response->assertStatus(422)
                ->assertJson([
                    'status' => 'error',
                    'message' => 'Validation error',
                ]);
    }

    /** @test */
    public function it_can_destroy_a_menu()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        $menu = Menu::create([
            'nama_menu' => 'Tes Menu',
            'hak_akses' => 1,
        ]);

        $response = $this->deleteJson('/api/admin/menu/' . $menu->id);

        $response->assertStatus(200)
                ->assertJson([
                    'status' => 'success',
                    'message' => 'menu has been removed',
                ]);
    }

    /** @test */
    public function it_cannot_destroy_nonexistent_menu()
    {
        $this->actingAs($this->adminUser, 'sanctum');

        // Attempt to delete a non-existent sub-menu
        $response = $this->deleteJson('/api/admin/menu/999999');

        $response->assertStatus(500)
                ->assertJson([
                    'status' => 'error',
                    'message' => 'Failed to delete menu',
                ]);
    }
}
