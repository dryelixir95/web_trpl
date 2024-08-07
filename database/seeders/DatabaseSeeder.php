<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\kategoriMedia;
use App\Models\Menu;
use App\Models\setting;
use App\Models\Tag;
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

        kategoriMedia::create([
            'nama' => 'gambar',
        ]);
        kategoriMedia::create([
            'nama' => 'dokumen',
        ]);

        Tag::create([
            'tag' => 'Poliwangi',
        ]);
        Tag::create([
            'tag' => 'TRPL',
        ]);
        Tag::create([
            'tag' => 'News',
        ]);

        setting::create([
            'name' => 'dataLogoPublic',
            'value' => 'logo.png',
        ]);
        setting::create([
            'name' => 'dataIconPublic',
            'value' => 'logo.png',
        ]);
        setting::create([
            'name' => 'dataTittleWebPublic',
            'value' => 'TRPL Poliwangi',
        ]);
        setting::create([
            'name' => 'dataLogoAdmin',
            'value' => 'logo.svg',
        ]);
        setting::create([
            'name' => 'dataIconAdmin',
            'value' => 'favicon.jpg',
        ]);
        setting::create([
            'name' => 'dataTittleWebAdmin',
            'value' => 'Admin TRPL',
        ]);

        $this->call(KategoriPostSeeder::class);
    }
}
