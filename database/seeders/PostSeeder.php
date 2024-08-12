<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'judul' => 'Sejarah TRPL',
                'tanggal' => '2024-08-08',
                'kategori' => 1,
                'deskripsi' => 'Sarjana Terapan (Diploma 4) Teknologi Rekayasa Perangkat Lunak (Sarjana Terapan TRPL) merupakan program studi pada pendidikan vokasi. Diploma 4 (D4) adalah nama lain dari Sarjana Terapan. Program studi Sarjana Terapan TRPL berdiri pada tahun 2012 sesuai dengan SK Menteri Pendidikan dan Kebudayaan Republik Indonesia No. 238/E/O/2012 pada tanggal 6 Juli 2012 dengan nama Sarjana Terapan (DIV) Teknik Informatika. Perubahan nama dari program studi DIV Teknik Informatika menjadi DIV Teknologi Rekayasa Perangkat Lunak adalah mengikuti nomenklatur Program Studi sesuai Keputusan Menteri Riset, Teknologi, dan Pendidikan Tinggi Republik Indonesia Nomor 57/M/KPT/2019.

                                Keunggulan Program Studi D-IV Teknik Rekayasa Perangkat Lunak

                                1.  Program studi ini menghasilkan produk-produk rekayasa perangkat lunak yang modern dan inovatif sebagai solusi mengembangkan teknologi di masa kini.
                                2.  Program studi ini menghasilkan lulusan terampil dan komunikatif
                                3.  Pada program studi ini mahasiswa dipersiapkan untuk mampu mengelola hasil riset dan pengembangan yang bisa mendapatkan pengakuan di tingkat regional, nasional dan internasional.',
            ],
            [
                'judul' => 'Visi Misi Tujuan TRPL',
                'tanggal' => '2024-08-08',
                'kategori' => 2,
                'deskripsi' => '### Visi

                                Menjadi program studi yang berkualitas dan profesional di bidang Teknologi Rekayasa Perangkat Lunak untuk menunjang kebutuhan pasar global pada tahun 2027. d. Misi Program Studi.

                                ### Misi

                                Menyelenggarakan pendidikan dalam bidang rekayasa perangkat lunak untuk menghasilkan lulusan terampil, kompetitif, berjiwa pancasila, berkualifikasi nasional Indonesia, serta mampu mengembangkan diri ke jenjang yang lebih tinggi.

                                ### Tujuan

                                Program Studi Teknologi Rekayasa Perangkat Lunak (TRPL) merupakan Program Pendidikan Sarjana Terapan bidang Rekayasa Perangkat Lunak untuk menunjang berbagai sektor. Program studi ini berfokus menghasilkan lulusan yang siap terjun ke dunia kerja dalam menyelesaikan persoalan-persoalan di bidang keilmuannya, berwawasan global dan mampu bersaing pada tingkat regional, nasional maupun internasional sesuai dengan kebutuhan dan perkembangan industri.'
            ],
            [
                'judul' => 'Kurikulum Program Studi Teknologi Rekayasa Perangkat Lunak',
                'tanggal' => '2024-08-08',
                'kategori' => 3,
                'deskripsi' => '<table class="ck-table-resized"><colgroup><col style="width:43.54%;"><col style="width:56.46%;"></colgroup><tbody><tr><td>Semester&nbsp;</td><td>File</td></tr><tr><td>Semester 1</td><td><p><a href="/media/media_66b993aee81c7.pdf">Lihat File</a></p></td></tr><tr><td>Semester 2</td><td><p><a href="/media/media_66b993aee81c7.pdf">Lihat File</a></p></td></tr><tr><td>Semester 3</td><td><p><a href="/media/media_66b993aee81c7.pdf">Lihat File</a></p></td></tr><tr><td>Semester 4</td><td><p><a href="/media/media_66b993aee81c7.pdf">Lihat File</a></p></td></tr><tr><td>Semester 5</td><td><p><a href="/media/media_66b993aee81c7.pdf">Lihat File</a></p></td></tr><tr><td>Semester 6</td><td><p><a href="/media/media_66b993aee81c7.pdf">Lihat File</a></p></td></tr><tr><td>Semester 7</td><td><p><a href="/media/media_66b993aee81c7.pdf">Lihat File</a></p></td></tr><tr><td>Semester 8</td><td><p><a href="/media/media_66b993aee81c7.pdf">Lihat File</a></p></td></tr></tbody></table>',
            ],
            [
                'judul' => 'Akreditas Program Studi Teknologi Rekayasa Perangkat Lunak',
                'tanggal' => '2024-08-08',
                'kategori' => 4,
                'deskripsi' => '![](/media/ckeditor/media_66af231351b99.jpg)

                                ###### Program Studi Teknologi Rekayasa Perangkat Lunak telah terakreditasi **B** sejak tanggal 24-juli-2019',
            ],
            [
                'judul' => 'LAB. BASIS DATA',
                'tanggal' => '2024-08-08',
                'kategori' => 5,
                'deskripsi' => '![](/media/ckeditor/media_66b0bd187fac1.jpeg)

                                Laboratorium Basis Data adalah Laboratorium Komputer yang digunakan untuk mendukung pengajaran praktikum serta berorientasi pada manajemen data dan tata kelola data.',
            ],
            [
                'judul' => 'LAB. HARDWARE',
                'tanggal' => '2024-08-08',
                'kategori' => 5,
                'deskripsi' => '![](/media/ckeditor/media_66b0bd187fac1.jpeg)

                                Laboratorium Basis Data adalah Laboratorium Komputer yang digunakan untuk mendukung pengajaran praktikum serta berorientasi pada manajemen data dan tata kelola data.',
            ],
            [
                'judul' => 'LAB. COWORKING',
                'tanggal' => '2024-08-08',
                'kategori' => 5,
                'deskripsi' => '![](/media/ckeditor/media_66b0bd187fac1.jpeg)

                                Laboratorium Basis Data adalah Laboratorium Komputer yang digunakan untuk mendukung pengajaran praktikum serta berorientasi pada manajemen data dan tata kelola data.',
            ],
            [
                'judul' => 'Dosen Dan Staff',
                'tanggal' => '2024-08-08',
                'kategori' => 6,
                'deskripsi' => '<table class="ck-table-resized"><colgroup><col style="width:46.55%;"><col style="width:26.73%;"><col style="width:26.72%;"></colgroup><tbody><tr><td><p style="text-align:center;">Nama</p></td><td><p style="text-align:center;">Homebase</p></td><td><p style="text-align:center;">Link Jurnal</p></td></tr><tr><td>Subono, ST.,MT.</td><td><p style="text-align:center;">Teknologi Rekayasa Perangkat Lunak</p></td><td>&nbsp;</td></tr><tr><td>Mohammad Dimyati Ayatullah, S.T.,M.Kom.</td><td><p style="text-align:center;">Teknologi Rekayasa Perangkat Lunak&nbsp;</p></td><td>&nbsp;</td></tr><tr><td>Herman Yuliandoko, S.T.,M.T.</td><td><p style="text-align:center;">Teknologi Rekayasa Perangkat Lunak</p></td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td><p style="text-align:center;">&nbsp;</p></td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td><p style="text-align:center;">&nbsp;</p></td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td><p style="text-align:center;">&nbsp;</p></td><td>&nbsp;</td></tr></tbody></table>',
            ],
            [
                'judul' => 'Struktur Organisasi TRPL',
                'tanggal' => '2024-08-08',
                'kategori' => 7,
                'deskripsi' => '![](/media/ckeditor/media_66b07c1e91447.png)',
            ],

//  nyusul isine

            [
                'judul' => 'Berita 1',
                'tanggal' => '2024-08-08',
                'kategori' => 14,
                'deskripsi' => '![](/media/ckeditor/media_66af3b1df0431.jpg)

                                ### PENDAFTARAN JALUR SELEKSI MANDIRI POLITEKNIK NEGERI BANYUWANGI TELAH DIBUKA!

                                Jalur Mandiri atau disebut juga Ujian Mandiri adalah nama yang digunakan oleh masyarakat secara umum untuk menyebut sistem penerimaan mahasiswa baru (PMB) yang dilakukan oleh perguruan tinggi negeri yang dilaksanakan secara mandiri oleh masing-masing perguruan tinggi negeri di Indonesia. Pada tahun 2024 ini, Politeknik Negeri Banyuwangi menyelenggarakan Tiga jalur Mandiri yaitu Jalur Seleksi Mandiri Konsorsium, Jalur Seleksi Siswa Mandiri Berprestasi (S2MB), dan UTBK Mandiri Politeknik Negeri Banyuwangi.

                                JALUR SELEKSI MANDIRI KONSORSIUM POLITEKNIK NEGERI BANYUWANGI

                                A. JADWAL PENDAFTARAN

                                Pendaftaran : 02 Mei – 20 Juni 2024  
                                Pelaksanaan Tes UTBK : 22 Juni 2024  
                                Pengumuman Hasil : 08 Juli 2024  
                                B. MATERI UJIAN

                                Tes Potensi Skolastik (TPS)  
                                Literasi dalam Bahasa Indonesia dan Bahasa Inggris  
                                Penalaran Matematika  
                                C. LOKASI UTBK

                                Lokasi Pelaksanaan UTBK di Kampus Politeknik Negeri Banyuwangi.

                                D. PILIHAN PROGRAM STUDI

                                Siswa dapat memilih 2 pilihan program studi di Politeknik Negeri Banyuwangi

                                S1 Terapan Teknologi Pengolahan Hasil Ternak  
                                S1 Terapan Teknologi Budi Daya Perikanan/Teknologi Akuakultur  
                                S1 Terapan Teknologi Produksi Ternak  
                                S1 Terapan Agribisnis  
                                S1 Terapan Teknologi Produksi Tanaman Pangan  
                                S1 Terapan Pengembangan Produk Agroindustri  
                                S1 Terapan Teknik Konstruksi Jalan dan Jembatan  
                                S1 Terapan Teknologi Rekayasa Manufaktur  
                                S1 Terapan Teknologi Manufaktur Kapal  
                                S1 Terapan Teknologi Rekayasa Perangkat Lunak  
                                S1 Terapan Teknologi Rekayasa Komputer  
                                S1 Terapan Bisnis Digital  
                                S1 Terapan Destinasi Pariwisata  
                                S1 Terapan Pengelolaan Perhotelan  
                                S1 Terapan Manajemen Bisnis Pariwisata  
                                D3 Teknik Sipil  
                                Serta dapat memilih 2 pilihan program studi di Politeknik Negeri Se Indonesia',
            ],
            [
                'judul' => 'Berita 2',
                'tanggal' => '2024-08-08',
                'kategori' => 14,
                'deskripsi' => '![](/media/ckeditor/media_66af3b1df0431.jpg)

                                ### PENDAFTARAN JALUR SELEKSI MANDIRI POLITEKNIK NEGERI BANYUWANGI TELAH DIBUKA!

                                Jalur Mandiri atau disebut juga Ujian Mandiri adalah nama yang digunakan oleh masyarakat secara umum untuk menyebut sistem penerimaan mahasiswa baru (PMB) yang dilakukan oleh perguruan tinggi negeri yang dilaksanakan secara mandiri oleh masing-masing perguruan tinggi negeri di Indonesia. Pada tahun 2024 ini, Politeknik Negeri Banyuwangi menyelenggarakan Tiga jalur Mandiri yaitu Jalur Seleksi Mandiri Konsorsium, Jalur Seleksi Siswa Mandiri Berprestasi (S2MB), dan UTBK Mandiri Politeknik Negeri Banyuwangi.

                                JALUR SELEKSI MANDIRI KONSORSIUM POLITEKNIK NEGERI BANYUWANGI

                                A. JADWAL PENDAFTARAN

                                Pendaftaran : 02 Mei – 20 Juni 2024  
                                Pelaksanaan Tes UTBK : 22 Juni 2024  
                                Pengumuman Hasil : 08 Juli 2024  
                                B. MATERI UJIAN

                                Tes Potensi Skolastik (TPS)  
                                Literasi dalam Bahasa Indonesia dan Bahasa Inggris  
                                Penalaran Matematika  
                                C. LOKASI UTBK

                                Lokasi Pelaksanaan UTBK di Kampus Politeknik Negeri Banyuwangi.

                                D. PILIHAN PROGRAM STUDI

                                Siswa dapat memilih 2 pilihan program studi di Politeknik Negeri Banyuwangi

                                S1 Terapan Teknologi Pengolahan Hasil Ternak  
                                S1 Terapan Teknologi Budi Daya Perikanan/Teknologi Akuakultur  
                                S1 Terapan Teknologi Produksi Ternak  
                                S1 Terapan Agribisnis  
                                S1 Terapan Teknologi Produksi Tanaman Pangan  
                                S1 Terapan Pengembangan Produk Agroindustri  
                                S1 Terapan Teknik Konstruksi Jalan dan Jembatan  
                                S1 Terapan Teknologi Rekayasa Manufaktur  
                                S1 Terapan Teknologi Manufaktur Kapal  
                                S1 Terapan Teknologi Rekayasa Perangkat Lunak  
                                S1 Terapan Teknologi Rekayasa Komputer  
                                S1 Terapan Bisnis Digital  
                                S1 Terapan Destinasi Pariwisata  
                                S1 Terapan Pengelolaan Perhotelan  
                                S1 Terapan Manajemen Bisnis Pariwisata  
                                D3 Teknik Sipil  
                                Serta dapat memilih 2 pilihan program studi di Politeknik Negeri Se Indonesia',
            ],
            [
                'judul' => 'Berita 3',
                'tanggal' => '2024-08-08',
                'kategori' => 14,
                'deskripsi' => '![](/media/ckeditor/media_66af3b1df0431.jpg)

                                ### PENDAFTARAN JALUR SELEKSI MANDIRI POLITEKNIK NEGERI BANYUWANGI TELAH DIBUKA!

                                Jalur Mandiri atau disebut juga Ujian Mandiri adalah nama yang digunakan oleh masyarakat secara umum untuk menyebut sistem penerimaan mahasiswa baru (PMB) yang dilakukan oleh perguruan tinggi negeri yang dilaksanakan secara mandiri oleh masing-masing perguruan tinggi negeri di Indonesia. Pada tahun 2024 ini, Politeknik Negeri Banyuwangi menyelenggarakan Tiga jalur Mandiri yaitu Jalur Seleksi Mandiri Konsorsium, Jalur Seleksi Siswa Mandiri Berprestasi (S2MB), dan UTBK Mandiri Politeknik Negeri Banyuwangi.

                                JALUR SELEKSI MANDIRI KONSORSIUM POLITEKNIK NEGERI BANYUWANGI

                                A. JADWAL PENDAFTARAN

                                Pendaftaran : 02 Mei – 20 Juni 2024  
                                Pelaksanaan Tes UTBK : 22 Juni 2024  
                                Pengumuman Hasil : 08 Juli 2024  
                                B. MATERI UJIAN

                                Tes Potensi Skolastik (TPS)  
                                Literasi dalam Bahasa Indonesia dan Bahasa Inggris  
                                Penalaran Matematika  
                                C. LOKASI UTBK

                                Lokasi Pelaksanaan UTBK di Kampus Politeknik Negeri Banyuwangi.

                                D. PILIHAN PROGRAM STUDI

                                Siswa dapat memilih 2 pilihan program studi di Politeknik Negeri Banyuwangi

                                S1 Terapan Teknologi Pengolahan Hasil Ternak  
                                S1 Terapan Teknologi Budi Daya Perikanan/Teknologi Akuakultur  
                                S1 Terapan Teknologi Produksi Ternak  
                                S1 Terapan Agribisnis  
                                S1 Terapan Teknologi Produksi Tanaman Pangan  
                                S1 Terapan Pengembangan Produk Agroindustri  
                                S1 Terapan Teknik Konstruksi Jalan dan Jembatan  
                                S1 Terapan Teknologi Rekayasa Manufaktur  
                                S1 Terapan Teknologi Manufaktur Kapal  
                                S1 Terapan Teknologi Rekayasa Perangkat Lunak  
                                S1 Terapan Teknologi Rekayasa Komputer  
                                S1 Terapan Bisnis Digital  
                                S1 Terapan Destinasi Pariwisata  
                                S1 Terapan Pengelolaan Perhotelan  
                                S1 Terapan Manajemen Bisnis Pariwisata  
                                D3 Teknik Sipil  
                                Serta dapat memilih 2 pilihan program studi di Politeknik Negeri Se Indonesia',
            ],

            [
                'judul' => 'MITRA TRPL',
                'tanggal' => '2024-08-08',
                'kategori' => 15,
                'deskripsi' => '![](/media/ckeditor/media_66b4f9899aadf.png)

                                ![](/media/ckeditor/media_66b4f989e2c92.png)

                                ![](/media/ckeditor/media_66b4f98b6558d.png)

                                ![](/media/ckeditor/media_66b4f98a24e78.png)

                                ![](/media/ckeditor/media_66b4f98adfe8e.png)

                                ![](/media/ckeditor/media_66b4fa560b67e.jpg)

                                ![](/media/ckeditor/media_66b4fa56477f5.jpg)

                                ![](/media/ckeditor/media_66b4f98b27665.png)

                                ![](/media/ckeditor/media_66b4f98a9cd41.png)

                                ![](/media/ckeditor/media_66b4f98ba4b49.png)',
            ],

        ];

        foreach ($posts as $post) {
            DB::table('kategori_posts')->insert($post);
        }
    }
}
