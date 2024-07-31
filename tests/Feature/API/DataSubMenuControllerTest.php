<?php
namespace Tests\Feature\API;

use App\Models\User;
use App\Models\SubMenu;
use App\Models\DataSubMenu;
use App\Models\DetailDataSubMenu;
use App\Models\SubMenuField;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class DataSubMenuControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $adminUser;
    protected $subMenu;

    protected function setUp(): void
    {
        parent::setUp();

        $this->adminUser = User::factory()->create([
            'role' => 'Admin',
            'password' => Hash::make('password'),
        ]);

        $this->subMenu = SubMenu::create([
            'nama_menu' => 'Test Submenu'
        ]);
    }


}
