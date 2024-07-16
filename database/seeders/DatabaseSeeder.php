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

        // // submenu create
        // SubMenu::create([
        //     'nama_menu' => 'Sejarah TRPL',
        //     'kategori' => 'profil-prodi',
        //     'menu_id' => '1',
        // ]);
        // SubMenu::create([
        //     'nama_menu' => 'Visi Misi Tujuan TRPL',
        //     'kategori' => 'profil-prodi',
        //     'menu_id' => '1',
        // ]);
        // SubMenu::create([
        //     'nama_menu' => 'Kurikulum',
        //     'kategori' => 'profil-prodi',
        //     'menu_id' => '1',
        // ]);
        // SubMenu::create([
        //     'nama_menu' => 'Akreditasi',
        //     'kategori' => 'profil-prodi',
        //     'menu_id' => '1',
        // ]);
        // SubMenu::create([
        //     'nama_menu' => 'Fasilitas',
        //     'kategori' => 'profil-prodi',
        //     'menu_id' => '1',
        // ]);
        // SubMenu::create([
        //     'nama_menu' => 'Dosen dan Staff',
        //     'kategori' => 'profil-prodi',
        //     'menu_id' => '1',
        // ]);
        // SubMenu::create([
        //     'nama_menu' => 'Struktur Organisasi',
        //     'kategori' => 'profil-prodi',
        //     'menu_id' => '1',
        // ]);

        // // menu kemahasiswaan
        // SubMenu::create([
        //     'nama_menu' => 'Kegiatan',
        //     'kategori' => 'kemahasiswaan',
        //     'menu_id' => '2',
        // ]);
        // SubMenu::create([
        //     'nama_menu' => 'Prestasi',
        //     'kategori' => 'kemahasiswaan',
        //     'menu_id' => '2',
        // ]);

        // SubMenu::create([
        //     'nama_menu' => 'Mutu',
        //     'kategori' => 'dokumen',
        //     'menu_id' => '3',
        // ]);
        // SubMenu::create([
        //     'nama_menu' => 'MKI',
        //     'kategori' => 'dokumen',
        //     'menu_id' => '3',
        // ]);
        // SubMenu::create([
        //     'nama_menu' => 'TA',
        //     'kategori' => 'dokumen',
        //     'menu_id' => '3',
        // ]);
        // SubMenu::create([
        //     'nama_menu' => 'Surat Edar Mahasiswa',
        //     'kategori' => 'dokumen',
        //     'menu_id' => '3',
        // ]);
    }
}
