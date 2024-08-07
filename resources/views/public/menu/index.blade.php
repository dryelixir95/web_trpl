@extends('public.app')
@section('content')

    <!-- Hero Section -->
<div class="section" style="background-color: #dee2e6; border-radius: 5px;">
    <div class="hero-section">
        <div class="container">
            <h2 class="text-center pt-4" id="judul"></h2>
        </div>
    </div>
    <!-- Akhir Hero Section -->

    <!-- Sejarah Section -->
    <div class="container mt-5 mb-3">
        <div class="row">
            <div class="col-md-12" id="data_halaman" hidden>
                <h3><u>Awal Mula</u></h3>
                <p>
                    Program Studi Teknologi Rekayasa Perangkat Lunak (TRPL) didirikan pada tahun 2005 sebagai bagian dari upaya Politeknik Negeri Banyuwangi untuk menjawab kebutuhan industri yang semakin berkembang dalam bidang teknologi informasi. Dengan visi untuk mencetak tenaga ahli yang kompeten di bidang perangkat lunak, TRPL bertujuan untuk menghasilkan lulusan yang siap menghadapi tantangan teknologi yang terus berubah.
                </p>
                
                <h3><u>Perkembangan</u></h3>
                <p>
                    Sejak berdirinya, program studi ini telah mengalami berbagai fase perkembangan yang signifikan. Pada tahun 2008, TRPL mulai mengembangkan kurikulum berbasis kompetensi yang disesuaikan dengan kebutuhan industri. Selama periode ini, berbagai kerjasama dengan perusahaan teknologi besar dilakukan untuk meningkatkan kualitas pendidikan dan pelatihan bagi mahasiswa.
                </p>

                <h3><u>Pengembangan Kurikulum</u></h3>
                <p>
                    Pada tahun 2012, kurikulum program studi mengalami revisi besar-besaran untuk memasukkan mata kuliah terbaru dan teknologi terkini. Program studi ini juga mulai menawarkan berbagai program sertifikasi profesional yang mendukung pengembangan keterampilan mahasiswa dalam berbagai bidang, termasuk pengembangan perangkat lunak, keamanan siber, dan manajemen proyek IT.
                </p>

                <h3><u>Prestasi dan Pengakuan</u></h3>
                <p>
                    Program Studi TRPL telah mendapatkan berbagai penghargaan dan pengakuan atas kualitas pendidikannya. Pada tahun 2015, program studi ini memperoleh akreditasi unggul dari Badan Akreditasi Nasional Perguruan Tinggi (BAN-PT). Selain itu, banyak lulusan TRPL yang berhasil menempati posisi penting di perusahaan teknologi terkemuka di Indonesia maupun internasional.
                </p>

                <h3><u>Masa Depan</u></h3>
                <p>
                    Melihat ke depan, Program Studi TRPL berkomitmen untuk terus beradaptasi dengan perkembangan teknologi dan kebutuhan industri. Dengan fokus pada inovasi dan pengembangan berkelanjutan, program studi ini berencana untuk memperkenalkan lebih banyak inisiatif penelitian, kolaborasi internasional, dan peluang bagi mahasiswa untuk berkontribusi pada proyek-proyek teknologi mutakhir.
                </p>
            </div>
            <div class="col-md-12" id="data_halaman_multi">
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $('#judul').append('<u>Sejarah Program Studi Teknologi Rekayasa Perangkat Lunak</u>')
        // $('#judul').append('<u>'+kategori.judul+'</u>')
        // $('#judul').append(`${post.deskripsi}`)

        var container = $('#data_halaman_multi');

        var card = `
                <div class="d-flex border border-primary rounded overflow-hidden mb-3 shadow-sm">
                    <img src="https://via.placeholder.com/200" alt="Gambar Berita" class="flex-shrink-0" style="width: 200px; height: 200px; object-fit: cover;">
                    <div class="p-3">
                        <h5 class="card-title">Judul Berita</h5>
                        <p class="card-text">Keterangan singkat tentang berita yang memberikan informasi lebih lanjut.Keterangan singkat tentang berita yang memberikan informasi lebih lanjut.Keterangan singkat tentang berita yang memberikan informasi lebih lanjut.Keterangan singkat tentang berita yang memberikan informasi lebih lanjut.Keterangan singkat tentang berita yang memberikan informasi lebih lanjut.Keterangan singkat tentang berita yang memberikan informasi lebih lanjut.</p>
                        <a href="#" class="btn btn-primary">Selengkapnya</a>
                    </div>
                </div>
        `;
        container.append(card);

        $.ajax({
            url: '/api/public/kategori-post',
            method: 'GET',
            success: function(data) {

            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });
    });
</script>
@endsection
