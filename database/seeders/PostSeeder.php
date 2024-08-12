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
                'kategori' => 1, //sejarahTRPL

                'deskripsi' => 'Sarjana Terapan (Diploma 4) Teknologi Rekayasa Perangkat Lunak (Sarjana Terapan TRPL) merupakan program studi pada pendidikan vokasi. Diploma 4 (D4) adalah nama lain dari Sarjana Terapan. Program studi Sarjana Terapan TRPL berdiri pada tahun 2012 sesuai dengan SK Menteri Pendidikan dan Kebudayaan Republik Indonesia No. 238/E/O/2012 pada tanggal 6 Juli 2012 dengan nama Sarjana Terapan (DIV) Teknik Informatika. Perubahan nama dari program studi DIV Teknik Informatika menjadi DIV Teknologi Rekayasa Perangkat Lunak adalah mengikuti nomenklatur Program Studi sesuai Keputusan Menteri Riset, Teknologi, dan Pendidikan Tinggi Republik Indonesia Nomor 57/M/KPT/2019.

Keunggulan Program Studi D-IV Teknik Rekayasa Perangkat Lunak :

1.  Program studi ini menghasilkan produk-produk rekayasa perangkat lunak yang modern dan inovatif sebagai solusi mengembangkan teknologi di masa kini.
2.  Program studi ini menghasilkan lulusan terampil dan komunikatif.
3.  Pada program studi ini mahasiswa dipersiapkan untuk mampu mengelola hasil riset dan pengembangan yang bisa mendapatkan pengakuan di tingkat regional, nasional dan internasional.',
            ],
            [
                'judul' => 'Visi Misi Tujuan TRPL',
                'tanggal' => '2024-08-08',
                'kategori' => 2, //visiMisi
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
                'kategori' => 3, //kurikulum
                'deskripsi' => '<table class="ck-table-resized"><colgroup><col style="width:43.54%;"><col style="width:56.46%;"></colgroup><tbody><tr><td>Semester&nbsp;</td><td>File</td></tr><tr><td>Semester 1</td><td><p><a href="/media/media_66b993aee81c7.pdf">Lihat File</a></p></td></tr><tr><td>Semester 2</td><td><p><a href="/media/media_66b993aee81c7.pdf">Lihat File</a></p></td></tr><tr><td>Semester 3</td><td><p><a href="/media/media_66b993aee81c7.pdf">Lihat File</a></p></td></tr><tr><td>Semester 4</td><td><p><a href="/media/media_66b993aee81c7.pdf">Lihat File</a></p></td></tr><tr><td>Semester 5</td><td><p><a href="/media/media_66b993aee81c7.pdf">Lihat File</a></p></td></tr><tr><td>Semester 6</td><td><p><a href="/media/media_66b993aee81c7.pdf">Lihat File</a></p></td></tr><tr><td>Semester 7</td><td><p><a href="/media/media_66b993aee81c7.pdf">Lihat File</a></p></td></tr><tr><td>Semester 8</td><td><p><a href="/media/media_66b993aee81c7.pdf">Lihat File</a></p></td></tr></tbody></table>',
            ],
            [
                'judul' => 'Akreditas Program Studi Teknologi Rekayasa Perangkat Lunak',
                'tanggal' => '2024-08-08',
                'kategori' => 4, //akreditasi
                'deskripsi' => '![](/media/ckeditor/media_66af231351b99.jpg)

###### Program Studi Teknologi Rekayasa Perangkat Lunak telah terakreditasi **B** sejak tanggal 24-juli-2019',
            ],
            [
                'judul' => 'LAB. BASIS DATA',
                'tanggal' => '2024-08-08',
                'kategori' => 5, //fasilitas
                'deskripsi' => '![](/media/ckeditor/media_66b0bd187fac1.jpeg)

Laboratorium Basis Data adalah Laboratorium Komputer yang digunakan untuk mendukung pengajaran praktikum serta berorientasi pada manajemen data dan tata kelola data.',
            ],
            [
                'judul' => 'LAB. DESAIN',
                'tanggal' => '2024-08-08',
                'kategori' => 5, //fasilitas
                'deskripsi' => '![](/media/ckeditor/d7b6e6_Lab._Desain.jpeg)

Laboratorium Desain Teknik adalah laboratorium berbasis komputer yang digunakan untuk proses perancangan, pemodelan dan simulasi. Laboratorium Desain Teknik dilengkapi dengan komputer spesifikasi tinggi dengan berbagai perangkat lunak.',
            ],
            [
                'judul' => 'LAB. HARDWARE',
                'tanggal' => '2024-08-08',
                'kategori' => 5, //fasilitas
                'deskripsi' => '![](/media/ckeditor/media_66b0bd187fac1.jpeg)

Laboratorium Basis Data adalah Laboratorium Komputer yang digunakan untuk mendukung pengajaran praktikum serta berorientasi pada manajemen data dan tata kelola data.',
            ],
            [
                'judul' => 'LAB. COWORKING',
                'tanggal' => '2024-08-08',
                'kategori' => 5, //fasilitas
                'deskripsi' => '![](/media/ckeditor/media_66b0bd187fac1.jpeg)

Laboratorium Basis Data adalah Laboratorium Komputer yang digunakan untuk mendukung pengajaran praktikum serta berorientasi pada manajemen data dan tata kelola data.',
            ],
            [
                'judul' => 'Dosen Dan Staff',
                'tanggal' => '2024-08-08',
                'kategori' => 6, //dosenStaff
                'deskripsi' => '<table class="ck-table-resized"><colgroup><col style="width:46.55%;"><col style="width:26.73%;"><col style="width:26.72%;"></colgroup><tbody><tr><td><p style="text-align:center;">Nama</p></td><td><p style="text-align:center;">Homebase</p></td><td><p style="text-align:center;">Link Jurnal</p></td></tr><tr><td>Subono, ST.,MT.</td><td><p style="text-align:center;">Teknologi Rekayasa Perangkat Lunak</p></td><td>&nbsp;</td></tr><tr><td>Mohammad Dimyati Ayatullah, S.T.,M.Kom.</td><td><p style="text-align:center;">Teknologi Rekayasa Perangkat Lunak&nbsp;</p></td><td>&nbsp;</td></tr><tr><td>Herman Yuliandoko, S.T.,M.T.</td><td><p style="text-align:center;">Teknologi Rekayasa Perangkat Lunak</p></td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td><p style="text-align:center;">&nbsp;</p></td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td><p style="text-align:center;">&nbsp;</p></td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td><p style="text-align:center;">&nbsp;</p></td><td>&nbsp;</td></tr></tbody></table>',
            ],
            [
                'judul' => 'Struktur Organisasi TRPL',
                'tanggal' => '2024-08-08',
                'kategori' => 7, //struktur organisasi
                'deskripsi' => '![](/media/ckeditor/media_66b07c1e91447.png)',
            ],

            [
                'judul' => 'Meriahkan HUT Ke-53, LANAL Banyuwangi Gelar Jalan Sehat & Family Game',
                'tanggal' => '2024-08-08',
                'kategori' => 8, //kegiatan
                'tag' => '["Poliwangi","News"]',
                'deskripsi' => '![](/media/ckeditor/media_66ba204b97b25.jpg)

Banyuwangi – Dalam rangka memperingati Hari Ulang Tahun (HUT) Pangkalan TNI Angkatan Laut (Lanal) Banyuwangi yang ke-53, Komandan Lanal Banyuwangi, Letkol Laut (P) Hafidz, M.Tr.Opsla, bersama para prajurit Lanal Banyuwangi, menggelar kegiatan “Jalan Sehat” yang berlangsung di Pantai Boom Marina, Minggu (4/8/2024) pagi.

Acara tersebut diikuti oleh sekitar 600 peserta yang terdiri dari keluarga besar prajurit TNI AL di bawah naungan Lanal Banyuwangi, pelajar SMA beserta guru, serta mahasiswa dari Politeknik Negeri Banyuwangi. Sebelum kegiatan dimulai, seluruh peserta terlebih dahulu melakukan doa bersama, dengan harapan agar rangkaian acara dapat berjalan lancar dan sukses.

Dalam sambutannya, Danlanal Banyuwangi, Letkol Laut (P) Hafidz, M.Tr.Opsla, menyampaikan bahwa kegiatan Jalan Sehat ini merupakan bagian dari peringatan HUT Lanal Banyuwangi yang ke-53. Ia juga menekankan pentingnya kegiatan tersebut sebagai sarana untuk mempererat silaturahmi antar prajurit TNI Angkatan Laut.

“Dengan silaturahmi, diharapkan terwujud kekompakan seluruh prajurit, sehingga mampu melaksanakan tugas dengan sebaik-baiknya,” ungkap Letkol Hafidz. Ia juga mengajak seluruh prajurit untuk terus berkomitmen dalam memajukan Lanal Banyuwangi. “Di usia ke-53 tahun ini, mari kita bersama wujudkan Lanal Banyuwangi yang semakin maju dan kompak,” tambahnya.

Ketua panitia pelaksana, Kapten Laut (P) Mariyanto, Komandan KAL Rajegwesi, menyampaikan bahwa melalui rangkaian kegiatan ini diharapkan dapat terjalin silaturahmi yang kuat antar prajurit, sehingga meningkatkan kinerja seluruh prajurit Lanal Banyuwangi. Ia juga menjelaskan bahwa selain Jalan Sehat, berbagai kegiatan lainnya seperti Lomba Perahu Layar Tradisional, Senam Bersama, serta berbagai lomba lainnya turut memeriahkan peringatan HUT Lanal Banyuwangi kali ini.

Berbagai hadiah menarik telah disiapkan oleh panitia untuk para peserta, mulai dari hadiah hiburan hingga hadiah utama seperti Kulkas 2 pintu, Sepeda Phoenix, Smart TV 32 Inch, Dispenser, Sofa Lipat, hingga Voucher Hotel. Total ada 242 hadiah yang dibagikan untuk para peserta.

Salah satu peserta, Ismi Fabiyani, mahasiswi Politeknik Negeri Banyuwangi, merasa sangat bahagia setelah berhasil membawa pulang hadiah berupa 1 unit sepeda Phoenix. “Alhamdulillah, saya tidak menyangka pulang bisa membawa hadiah sepeda,” ujarnya dengan penuh senyuman.

Kegiatan Jalan Sehat ini diharapkan dapat meningkatkan semangat dan kekompakan seluruh prajurit Lanal Banyuwangi dalam melaksanakan tugas sehari-hari.',
            ],
            [
                'judul' => 'Sambut Masa Depan Gemilang di Poliwangi Expo Tahun 2024!',
                'tanggal' => '2024-08-08',
                'kategori' => 8, //kegiatan
                'tag' => '["Poliwangi","News"]',
                'deskripsi' => '![](/media/ckeditor/media_66ba2087015ba.png)

Banyuwangi - Kabar gembira bagi Sobat Branggo yang sedang mencari peluang karir dan ingin melanjutkan pendidikan tinggi! Politeknik Negeri Banyuwangi akan menggelar Poliwangi Expo 2024. Acara ini akan diadakan pada tanggal 27-28 Juli 2024 di kampus Politeknik Negeri Banyuwangi.

Poliwangi Expo 2024 merupakan wadah bagi para pencari kerja, mahasiswa, dan masyarakat umum untuk mendapatkan informasi tentang berbagai peluang karir, pendidikan tinggi, dan kewirausahaan. Di acara ini, kamu akan menemukan:

Career Expo: Temui berbagai perusahaan ternama dan dapatkan informasi tentang lowongan pekerjaan terbaru.  
Recruitment Perusahaan: Ikuti seleksi langsung untuk berbagai posisi di perusahaan ternama.  
Job Seeker: Dapatkan tips dan trik untuk mencari pekerjaan dan meningkatkan karirmu.  
Bazaar: Temukan berbagai produk menarik dari UMKM dan mahasiswa Poliwangi.  
Pameran Produk Mahasiswa: Saksikan inovasi dan kreativitas mahasiswa Poliwangi dalam berbagai bidang.

Bagi perusahaan yang ingin berpartisipasi dalam Expo Poliwangi 2024, dapat menghubungi panitia melalui email jpc@poliwangi.ac.id',
            ],
            [
                'judul' => 'KONSORSIUM PTV JATIM SERAHKAN POLICY PAPER KE BAPPEDA',
                'tanggal' => '2024-08-08',
                'kategori' => 8, //kegiatan
                'tag' => '["Poliwangi","News"]',
                'deskripsi' => '![](/media/ckeditor/media_66ba2127bbad7.jpg)

Surabaya, 18 Juli 2024 - Konsorsium Perguruan Tinggi Vokasi (PTV) Provinsi Jawa Timur hari ini (18/07) menyerahkan dokumen Policy Paper kepada Badan Perencanaan Pembangunan Daerah (Bappeda) Provinsi Jawa Timur, pada gelaran Finalisasi Workforce Planning, Innovation Planning dan Model Ekosistem Kemitraan di Hotel Bumi Surabaya.

Dokumen yang memuat hasil kajian dari berbagai aspek ini, mengidentifikasi berbagai faktor yang mempengaruhi pengembangan pendidikan vokasi melalui analisis penggerak perubahan atau drivers of change, yang mencakup aspek sosial, teknologi, ekonomi, lingkungan, politik, dan budaya.

“Scenario planning yang dihasilkan menekankan pentingnya kolaborasi antara pemerintah pada sektor pendidikan vokasi dan Dunia Usaha Dunia Industri (DUDI) untuk mempersiapkan tenaga kerja dengan keterampilan yang relevan dalam bidang otomatisasi dan AI misalnya, serta mendukung pertumbuhan ekonomi yang berkelanjutan di Jawa Timur. Melalui pendekatan ini, diharapkan dapat tercipta ekosistem pendidikan vokasi yang lebih adaptif dan responsif terhadap kebutuhan pasar, sehingga mengurangi tingkat pengangguran dan mendorong inovasi berbasis potensi daerah,”terang Prof. Ir. Amang Sudarsono, ST, Ph.D. IPU didampingi tim peneliti dari 14 PTV yang turut hadir.

![](/media/ckeditor/media_66ba215c1e6d3.jpg)

Menurut Amang, pada model dynamic system workforce planning Jawa Timur diketahui jika perbandingan pemetaan tenaga kerja vokasi dan Produk Domestik Regional Bruto (PDRB) berdasarkan lapangan usaha menyatakan bahwa PDRB lapangan usaha transportasi dan pergudangan, jasa pendidikan, jasa kesehatan dan jasa lainnya mempunyai nilai kecil, meskipun lulusan di bidang lapangan usaha tersebut sangat besar.

Sementara itu, pada model dynamic system innovation planning Jawa Timur, diketahui tingkat teknologi dengan mempertimbangkan inovasi menunjukkan peningkatan dibandingkan tanpa mempertimbangkan inovasi. Hal ini berakibat penurunan tenaga kerja akibat keterlibatan teknologi, meski di satu sisi peningkatan inovasi dapat meningkatkan PDRB Jawa Timur.

Amang melanjutkan jika kondisi umum wilayah Jawa Timur menunjukkan fokus kuat pada peningkatan kualitas SDM, pengembangan teknologi, dan pengembangan pariwisata.

“Jawa Timur berada dalam fase transformasi yang kompleks akibat pengaruh globalisasi dan modernisasi. Tiga fokus utamanya yaitu peningkatan kualitas SDM, pengembangan teknologi, dan pariwisata. Peningkatan kualitas SDM diarahkan pada penciptaan tenaga kerja terampil yang sesuai dengan kebutuhan pasar kerja, termasuk penyesuaian kurikulum pendidikan dan pengembangan soft skill serta hard skill,”kata beliau.

Pada kesempatan yang sama dilakukan pengesahan sekaligus penyerahan dokumen Policy Paper Program Penguatan Kemitraan untuk Pengembangan Inovasi Berbasis Potensi Daerah di Jawa Timur, yang diserahkan langsung kepada Kepala Bappeda Provinsi Jawa Timur yang diwakili oleh Kukuh Tri Sandi, S.Pi, MT, M.Sc., Kepala bidang PPM Bappeda.

Tak hanya itu, dilaksanakan pula diseminasi Policy Paper sekaligus diskusi hasil kajian kepada seluruh undangan yang hadir, baik dari unsur perwakilan OPD/ pemerintahan, Dunia Usaha Dunia Industri, KADIN, Media dan SMK.

Amang menyampaikan apresiasi terhadap dukungan Pemerintah Daerah Provinsi Jawa Timur, melalui Bappeda, Dinas dan unsur pemerintahan di bawahnya, Mitra Dunia Usaha dan Dunia Industri, Media, SMK serta dukungan pembiayaan dari LPDP dan Mitras DUDI Kemendikbud, yang memungkinkan riset ini terlaksana.

“Mewakili 14 PTV di Jawa Timur, saya berharap apa yang telah dihasikan oleh rekan-rekan tim peneliti Konsorsium PTV Jawa Timur ini dapat digunakan sebagai referensi dan pertimbangan guna menyusun kebijakan bagi pemimpin daerah di Jawa Timur, ke depannya,”harapnya. (Andri Suryandari - Humas PENS)',
            ],
            [
                'judul' => 'OUTBOND LEADERSHIP MOTIVATION',
                'tanggal' => '2024-08-08',
                'kategori' => 8, //kegiatan
                'tag' => '["Poliwangi","News"]',
                'deskripsi' => '![](/media/ckeditor/media_66ba248ac4ff5.jpg)

Civitas akademika Politeknik Negeri Banyuwangi (Poliwangi) menyelenggarakan outbond bersama mahasiswa. Karo adventure adalah titik tempat diadakannya acara tersebut, tepatnya di Desa Sumber Bulu, Kecamatan Songgon, Kabupaten Banyuwangi. Kegiatan ini merupakan serangkaian Program dari Polytechnic Education Development Program (PEDP) yang dilaksanakan pada hari Sabtu (17/12/2016).

Seiring dengan kemajuan zaman, mahasiswa tidak hanya unggul dalam hardskill melainkan juga softskill yang bertujuan membentuk budi pekerti luhur dan akhlak mulia. Salah satu agenda tahunan Politeknik Negeri Banyuwangi untuk mendidik mahasiswa agar mempunyai softskill yaitu dengan cara outbond. Kegiatan tersebut rutin diselenggarakan, dan tempat yang diambil juga berlatar alam yang bertujuan menumbuhkan rasa leadersip, teamwork dan character building. Pada outbond kali ini diikuti oleh 200 mahasiswa Program Studi DIII Teknik Mesin dan DIII Teknik Informatika. Melalui beragam permainan yang mengasah kerjasama, kreatifitas dan kepemimpinan diharapkan nantinya bisa diterapkan ketika sudah lulus dari bangku kuliah. “Kami diharuskan untuk menyelesaikan tugas-tugas dalam permainan dengan mengandalkan kerjasama kelompok” tutur Leny Nurmalita peserta outbound jurusan Teknik Informatika.

Meskipun hanya satu hari, kegiatan ini berlangsung sangat meriah dan dapat membangun kerjasama antar peserta Program Studi DIII Teknik Mesin dan DIII Teknik Informatika. Semoga manfaat dari kegiatan outbond kali ini bisa terus melekat dalam diri peserta. (Nuruddin)',
            ],
            [
                'judul' => 'Politeknik Negeri Banyuwangi Raih Prestasi Gemilang di Kompetisi MTQ Politeknik Nasional Tahun 2024',
                'tanggal' => '2024-08-08',
                'kategori' => 9, //prestasi
                'tag' => '["Poliwangi","News","TRPL"]',
                'deskripsi' => '![](/media/ckeditor/media_66ba26383ccfb.jpg)

Banyuwangi, Jawa Timur - Politeknik Negeri Banyuwangi menorehkan prestasi membanggakan di kancah nasional. Empat mahasiswanya berhasil meraih juara pada Kompetisi MTQ Politeknik Nasional Tahun 2024 yang merupakan program dari Badan Koordinasi Kemahasiswaan (BAKORMA) Lingkup Vokasi dan yang tahun ini diselenggarakan oleh Politeknik Pertanian Negeri Pangkajene Kepulauan.

Mahasiswi dari program studi Teknik Rekayasa Perangkat Lunakk (TRPL), Shofia Maulidatua Sholekhah, berhasil meraih juara 2 dalam kategori Ceramah Putri Kategori Mumtaz. Di kategori Musabaqah Tilawah Putra Kategori Thoyyib, Aris Munandar Assabiqi juga dari program studi TRPL turut menyumbangkan medali perak.

Prestasi gemilang pun diraih Nur Hidayah dari program studi Teknik Sipil. Ia berhasil menjadi juara 1 dalam kategori Musabaqah Tilawah Quran Putri Shoutun Farid. Tak hanya itu, Nuril Mustofa dari program studi Manajemen Bisnis Pariwisata pun turut mengharumkan nama Poliwangi dengan meraih juara 2 di kategori yang sama.

Keberhasilan ini merupakan hasil dari dedikasi dan kerja keras para mahasiswa, serta bimbingan dari para pembimbing yang telah mempersiapkan mereka dengan matang. Prestasi ini menjadi bukti komitmen Poliwangi dalam mencetak generasi muda yang tidak hanya cerdas secara akademik, tetapi juga memiliki pemahaman mendalam tentang Al-Quran dan mampu mengamalkannya dalam kehidupan sehari-hari. Poliwangi terus berkomitmen untuk memberikan pendidikan yang berkualitas dan berkarakter kepada seluruh mahasiswanya.',
            ],
            [
                'judul' => '2 Tim dari TRPL meraih prestasi di KMIPN VI 2024.',
                'tanggal' => '2024-08-08',
                'kategori' => 9, //prestasi
                'tag' => '["Poliwangi","News","TRPL"]',
                'deskripsi' => '![](/media/ckeditor/media_66ba28940169c.jpeg)

![](/media/ckeditor/media_66ba28944e741.jpeg)

  
  
2 Tim dari TRPL meraih prestasi di KMIPN VI 2024.

Kompetisi Mahasiswa Informatika Politeknik Nasional (KMIPN) merupakan ajang bergengsi tahunan bagi institusi perguruan tinggi vokasi di bidang informatika. Tahun 2024 ini, KMIPN memasuki penyelenggaraan ke-VI dengan tema "Inovasi Vokasi untuk Tren Informatika Masa Depan".

Politeknik Negeri Banyuwangi mengirimkan 2 Tim dalam kompetisi ini, dan keduanya meraih predikat masing-masing.

Tim NAMATIN KMIPN  
Juara 2 Kategori Perancangan Bisnis TIK

1.  Jehan Khairul Anwar
2.  Muhammad Nanang N.
3.  Luluk Triyani

Tim SPARTAN  
Best Adaptation Kategori E-Government

1.  Avina Dwi Ratnasari
2.  Ferdian Firmansyah
3.  Rena Amalia Afifah

Apresiasi dan dukungan tetap kami berikan dan semoga terus memberikan yang terbaik.',
            ],
            [
                'judul' => 'Magang Kerja Industri',
                'tanggal' => '2024-08-08',
                'kategori' => 11, //MKI
                'deskripsi' => '<table class="ck-table-resized"><colgroup><col style="width:42.15%;"><col style="width:57.85%;"></colgroup><tbody><tr><td>Nama&nbsp;</td><td>File</td></tr><tr><td>Formulir MKI</td><td><p><a href="/media/media_66ba342121947.doc">Lihat File</a></p></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table>',
            ],
            [
                'judul' => 'Tugas Akhir',
                'tanggal' => '2024-08-08',
                'kategori' => 12, //TA
                'deskripsi' => '<table class="ck-table-resized"><colgroup><col style="width:34.16%;"><col style="width:65.84%;"></colgroup><tbody><tr><td>Nama</td><td>File</td></tr><tr><td>Ringkasan Topik TA</td><td><p><a href="/media/media_66ba35c4e535d.pdf">Lihat File</a></p></td></tr><tr><td>Formulir Kesediaan Pembimbing</td><td><p><a href="/media/media_66ba35d13afbc.pdf">Lihat File</a></p></td></tr></tbody></table>',
            ],
            [
                'judul' => 'Surat Edar Mahasiswa',
                'tanggal' => '2024-08-08',
                'kategori' => 13, //Surat Edar Mahasiswa
                'deskripsi' => '<table class="ck-table-resized"><colgroup><col style="width:37.43%;"><col style="width:62.57%;"></colgroup><tbody><tr><td>Nama</td><td>File</td></tr><tr><td>Form Bebas Tanggungan</td><td><p><a href="/media/media_66ba342121947.doc">Lihat File</a></p></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table>',
            ],


            [
                'judul' => 'PENDAFTARAN JALUR SELEKSI MANDIRI POLITEKNIK NEGERI BANYUWANGI TELAH DIBUKA',
                'tanggal' => '2024-08-08',
                'kategori' => 14,
                'tag' => '["Poliwangi","TRPL","News"]',
                'deskripsi' => '![](/media/ckeditor/media_66b9ca4913e66.jpg)

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
                'judul' => 'MSIB Bangkit 2023 Batch 2',
                'tanggal' => '2024-08-08',
                'kategori' => 14,
                'tag' => '["Poliwangi","TRPL","News"]',
                'deskripsi' => '![](/media/ckeditor/media_66b9ce9397935.jpg)

### MSIB Bangkit 2023 Batch 2  
Sabtu, 1 April 2023

Untuk Informasi Lebih Lanjut terkait Pendaftaran dan Persyaratan silahkan akses via: https://kampusmerdeka.kemdikbud.go.id/program/studi-independen/',
            ],
            [
                'judul' => '[PORSENI 2024]',
                'tanggal' => '2024-08-08',
                'kategori' => 14,
                'tag' => '["Poliwangi","TRPL","News"]',
                'deskripsi' => '![](/media/ckeditor/media_66ba2d9fbe61c.jpeg)

  
Mohon doa dan dukungan dari seluruh pihak serta "Selamat bertanding" kepada seluruh atlet dan artis dari Program Studi Teknologi Rekayasa Perangkat Lunak Politeknik Negeri Banyuwangi dalam laga Porseni (Pekan Olahraga dan Seni) Politeknik se-Indonesia di Politeknik Negeri Malang.

Yuk, wujudkan mimpi dan raih prestasimu dengan bergabung bersama program studi TRPL Poliwangi! Jangan sampai ketinggalan info pendaftarannya ya Sob🤩

Cek info PMB Poliwangi melalui Instagram @pmb.poliwangi atau laman website poliwangi.ac.id.',
            ],
            [
                'judul' => 'POLIWANGI Luncurkan Alat Mitigasi Bencana Tsunami | PIANDA Tsunami Early warning System (TEWS)',
                'tanggal' => '2024-08-08',
                'kategori' => 14,
                'tag' => '["Poliwangi","TRPL","News"]',
                'deskripsi' => '![](/media/ckeditor/media_66ba2b260fb3f.jpg)

  
  
ANTARA - Kabupaten Banyuwangi menjadi salah satu dari 8 kabupaten di Jawa Timur yang berpotensi tinggi terhadap tsunami. Beberapa wilayah di kabupaten ini memiliki kerawanan terhadap tsunami, utamanya wilayah-wilayah yang berada di sekitar pesisir pantai selatan.

Ditjen Vokasi Politeknik Negeri Banyuwangi (Poliwangi) berinisiatif meluncurkan alat mitigasi bencana tsunami Pianda Tsunami Early Warning System (TEWS). Perangkat ini diklaim menjadi perangkat pertama di Indonesia yang diintegrasikan dengan tempat ibadah seperti masjid, gereja, dan lainnya yang berpotensi terdampak tsunami.

Pianda TEWS terpasang di sepanjang garis pantai selatan Banyuwangi dan selat Bali yang menjadi salah satu lokasi rawan tsunami. Sebagai sistem mitigasi bencana, alat ini mampu menjangkau blank spot atau area yang tidak memiliki sinyal dengan baik, menggunakan teknologi frequency shift keying, tahan terhadap noise, dan tergolong ringkas. (Ahmad Faishal Adnan, Suci Nurhaliza, Fandi Yogari Saputra/Keysha Anissa/Fandi Yogari Saputra, Subur Atmamihardja, Syahrudin, Syamsul Rizal/Agha Yuninda Maulana/Ahmad Faishal Adnan)',
            ],
            [
                'judul' => 'Edukasi Kunci Negara Maju, RI Dinilai Perlu Kuatkan Pendidikan Generasi Muda',
                'tanggal' => '2024-08-08',
                'kategori' => 14,
                'tag' => '["News"]',
                'deskripsi' => '![](/media/ckeditor/media_66b9f1d875ec8.jpeg)  
**Jakarta** \- Tanoto Foundation memastikan mendukung terciptanya pemimpin-pemimpin masa depan Indonesia yang andal dan berkontribusi kepada masyarakat. Hal ini dilakukan salah satunya dengan menggelar Tanoto Scholars Gathering (FSG).

CEO Tanoto Foundation, Benny Lee, mengatakan bahwa ajang TSG ini dapat menjadi momentum bagi para peserta TSG untuk belajar hal-hal baru. Ia berharap hal ini dapat memperkaya wawasan para peserta.

"Kalian akan memiliki banyak kesempatan, mengujungi bagian-bagian organisasi kami, dan mendengar dialog inspiratif oleh para pakar. Saya harap Anda semua mengambil kesempatan ini dan belajar banyak dari perjalanan yang akan memperkaya wawasan Anda," ujar Benny Lee, dalam keterangan yang diterima, Sabtu (3/7/2024).

Disebutkan, TSG merupakan bagian dari program kepemimpinan dan beasiswa Tanoto Foundation yang bernama TELADAN (Transformasi Edukasi untuk melahirkan Pemimpin Masa Depan). Program ini memberikan beasiswa kepada para mahasiswa S1 berprestasi dari 10 universitas mitra Tanoto Foundation.

Benny menyatakan Tanoto Foundation akan terus memberi dukungan pengembangan pendidikan bagi ribuan pelajar dan mahasiswa. Kegiatan TSG ini juga diharapkan dapat menambah jaringan para pelajar untuk menyiapkan pemimpin-pemimpin di masa mendatang.

"Bertahun-tahun, Tanoto Scholarship telah memberikan beasiswa kepada lebih dari 8.000 pelajar. Beasiswa ini diberikan pada pelajar di seluruh dunia. Jadi melangkahlah dan menjadi bagian dari jaringan ini, dan saling membantu dengan baik," ujarnya.

"Manfaatkan kesempatan TSG ini untuk mengenal satu sama lain dengan baik, karena ini akan membentuk jaringan kalian di masa depan. Saling dukung satu sama lain dan tumbuh bersama menjadi pemimpin," kata Benny.

Menteri Keuangan RI (2014-2016) Menteri Perencanaan Pembangunan Nasional Republik Indonesia (PPN)/ Kepala Badan Perencanaan Pembangunan Nasional (Bappenas) (2016-2019), Menteri Riset dan Teknologi/ Kepala Badan Riset dan Inovasi Nasional (2019-2021) Prof. Bambang Brodjonegoro membuka sesi inspirational talk dalam TSG. Ia mengatakan jika Indonesia mau menjadi negara maju, kuncinya yakni fokus pada pengembangan manusianya.

"Jadi saya ingin menekankan bahwa kalau menjadi negara maju, kuncinya adalah di manusianya, yang kemudian fokus kepada pengembangan investasi di sektor manufaktur dengan beberapa produk unggulan. Itu yang saya coba samakan dari negara-negara ini," tuturnya.

Bambang menilai apa yang dilakukan oleh Tanoto Foundation lewat TSG 2024 dan program beasiswa kepemimpinannya sudah in line dengan cita-cita ini. Menurutnya ketika ingin menjadi negara maju, maka akan melewati suatu periode di mana yang menonjol di dunia adalah sustainability dan digital transformation.

"Tentunya ini menjadi pembelajaran juga bagi Anda semua, bagaimana nanti Anda berperan untuk memajukan Indonesia ke depan. Nah, kalau kita lihat pilar dari visi Indonesia 2045, pertama, mastery of science and technology. Ini harus. Paling tidak kalau kita bukan yang membuat, bukan kita yang menginovasi, kita bisa memakai dan mengembangkan," ujarnya.

**(dwia/dwia)**',
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
            $post['created_at'] = now();
            DB::table('posts')->insert($post);

            // Delay for 1 second (1,000,000 microseconds) between inserts
            usleep(1000000);
        }
    }
}
