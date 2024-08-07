<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KategoriPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'nama' => 'Sejarah TRPL',
                'slug' => Str::slug('Sejarah TRPL'),
                'index_menu' => 1,
                'deskripsi' => 'Semua tentang sejarah program studi TRPL',
                'type_halaman' => 'single-artikel',
            ],
            [
                'nama' => 'Visi Misi Tujuan TRPL',
                'slug' => Str::slug('Visi Misi Tujuan TRPL'),
                'index_menu' => 1,
                'deskripsi' => 'Halaman yang berisi tentang Visi Misi Tujuan TRPL',
                'type_halaman' => 'single-artikel',
            ],
            [
                'nama' => 'Kurikulum',
                'slug' => Str::slug('Kurikulum'),
                'index_menu' => 1,
                'deskripsi' => 'Halaman yang berisi kurikulum program studi TRPL',
                'type_halaman' => 'single-artikel',
            ],
            [
                'nama' => 'Akreditasi',
                'slug' => Str::slug('Akreditasi'),
                'index_menu' => 1,
                'deskripsi' => 'Halaman yang berisi Akreditasi program studi TRPL',
                'type_halaman' => 'single-artikel',
            ],
            [
                'nama' => 'Fasilitas',
                'slug' => Str::slug('Fasilitas'),
                'index_menu' => 1,
                'deskripsi' => 'Halaman yang berisi Fasilitas program studi TRPL',
                'type_halaman' => 'multi-artikel',
            ],
            [
                'nama' => 'Dosen dan Staff',
                'slug' => Str::slug('Dosen dan Staff'),
                'index_menu' => 1,
                'deskripsi' => 'Halaman yang berisi Dosen dan Staff program studi TRPL',
                'type_halaman' => 'single-artikel',
            ],
            [
                'nama' => 'Struktur Organisasi',
                'slug' => Str::slug('Struktur Organisasi'),
                'index_menu' => 1,
                'deskripsi' => 'Halaman yang berisi Struktur Organisasi program studi TRPL',
                'type_halaman' => 'single-artikel',
            ],
            [
                'nama' => 'Kegiatan',
                'slug' => Str::slug('Kegiatan'),
                'index_menu' => 2,
                'deskripsi' => 'Halaman yang berisi Kegiatan program studi TRPL',
                'type_halaman' => 'multi-artikel',
            ],
            [
                'nama' => 'Prestasi',
                'slug' => Str::slug('Prestasi'),
                'index_menu' => 2,
                'deskripsi' => 'Halaman yang berisi Prestasi program studi TRPL',
                'type_halaman' => 'multi-artikel',
            ],
            [
                'nama' => 'Mutu',
                'slug' => Str::slug('Mutu'),
                'index_menu' => 3,
                'deskripsi' => 'Halaman yang berisi Mutu program studi TRPL',
                'type_halaman' => 'single-artikel',
            ],
            [
                'nama' => 'Magang Kerja Industri',
                'slug' => Str::slug('Magang Kerja Industri'),
                'index_menu' => 3,
                'deskripsi' => 'Halaman yang berisi Magang Kerja Industri program studi TRPL',
                'type_halaman' => 'single-artikel',
            ],
            [
                'nama' => 'Tugas Akhir',
                'slug' => Str::slug('Tugas Akhir'),
                'index_menu' => 3,
                'deskripsi' => 'Halaman yang berisi Tugas Akhir program studi TRPL',
                'type_halaman' => 'single-artikel',
            ],
            [
                'nama' => 'Surat Edar Mahasiswa',
                'slug' => Str::slug('Surat Edar Mahasiswa'),
                'index_menu' => 3,
                'deskripsi' => 'Halaman yang berisi Surat Edar Mahasiswa program studi TRPL',
                'type_halaman' => 'single-artikel',
            ],
            [
                'nama' => 'Berita',
                'slug' => Str::slug('Berita'),
                'index_menu' => null,
                'beranda' => 1,
                'deskripsi' => 'Halaman yang berisi Berita program studi TRPL',
                'type_halaman' => 'multi-artikel',
            ],
            [
                'nama' => 'Kerjasama Mitra',
                'slug' => Str::slug('Kerjasama Mitra'),
                'index_menu' => null,
                'beranda' => 1,
                'deskripsi' => 'Halaman yang berisi Kerjasama Mitra program studi TRPL',
                'type_halaman' => 'single-artikel',
            ],
        ];

        foreach ($categories as $category) {
            DB::table('kategori_posts')->insert($category);
        }
    }
}
