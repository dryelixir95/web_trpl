<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Menu;
use App\Models\SubMenu;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '12345678',
            'role' => 'Admin',
        ]);
        User::factory()->create([
            'name' => 'Fathur Rohman',
            'email' => 'kaprodi@gmail.com',
            'password' => '12345678',
            'role' => 'Kaprodi'
        ]);

        Menu::create([
            'nama_menu' => 'Profil Prodi',
            'hak_akses' => '1'
        ]);

        Menu::create([
            'nama_menu' => 'Kemahasiswaan',
            'hak_akses' => '1'
        ]);

        Menu::create([
            'nama_menu' => 'Dokumen',
            'hak_akses' => '1'
        ]);
    }
}
