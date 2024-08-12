@extends('public.app')
@section('content')
<style>
    .card-title {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
    <!-- Hero Section -->
    <div class="hero-section bg-primary" style="padding-top: 5rem;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="text-white mt-3">
                        <p><b>Program Studi</b></p>
                        <h1 class="mt-2"><b>Teknologi Rekayasa Perangkat Lunak</b></h1>
                        <p class="mt-4">Menyediakan pendidikan berkualitas untuk menyiapkan karir mahasiswa dalam pengembangan perangkat lunak.</p>
                        <!-- <p class="text-center mt-2"><b>Algoritma | Pemrograman | Pengujian | Manajemen Proyek</b></p> -->
                    </div>
                </div>
                <div class="col-md-6 d-sm-none d-lg-block d-md-block mt-5" style="text-align: -webkit-right;">
                    <img src="{{asset('/src/images/komputer.png')}}" alt="komputer" class="img-fluid" style="width: 50%;">
                </div>
            </div>
        </div>
    </div>

    <div class="learning-section mt-4 mb-4">
        <div class="container">
            <div class="row">
                <div class="col-md-8" id="visiMisi">
                </div>
                <div class="col-md-4 d-flex flex-column justify-content-center" id="akreditasi">
                </div>
            </div>
        </div>
    </div>

    <div class="learning-section mt-4">
        <div class="container">
            <h2 class="text-center"><b>Berita Terbaru</b></h2>
            <div class="row" id="berita">

            </div>
        </div>
    </div>

    <div class="learning-section mt-2 mb-3">
        <div class="container">
            <div class="card bg-light" style="border-radius: 15px;">
                <div class="card-body">
                    <h2 class="text-center"><b>Fasilitas</b></h2>
                    <div class="row px-4" id="fasilitas">
                        <!-- Dynamic content will be inserted here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    $(document).ready(function() {
        function stripHtml(html) {
            var doc = new DOMParser().parseFromString(html, 'text/html');
            return doc.body.textContent || "";
        }

        $.ajax({
            url: '/api/public/beranda', 
            method: 'GET',
            success: function(data) {
                var dataBerita = data.kategori.filter(kategori => kategori.nama == 'Berita')[0]?.post ?? [];
                var dataFasilitas = data.kategori.filter(kategori => kategori.nama == 'Fasilitas')[0]?.post ?? [];
                var dataAkreditasi = data.kategori.filter(kategori => kategori.nama == 'Akreditasi')[0]?.post ?? [];
                var dataVisiMisi = data.kategori.filter(kategori => kategori.nama == 'Visi Misi Tujuan TRPL')[0]?.post ?? [];
                
                dataBerita.sort(function(a, b) {
                    // Parse the 'tanggal' field (YYYY-MM-DD)
                    var dateA = new Date(a.tanggal);
                    var dateB = new Date(b.tanggal);

                    // Compare the 'tanggal' first
                    if (dateA.getTime() !== dateB.getTime()) {
                        return dateB - dateA; // Newer dates first
                    } else {
                        // If 'tanggal' is the same, compare by 'created_at'
                        var createdAtA = new Date(a.created_at);
                        var createdAtB = new Date(b.created_at);
                        return createdAtB - createdAtA; // Newer timestamps first
                    }
                });

                $('#berita').empty();
                var index = 1;
                dataBerita.forEach(function(post) {
                    if(index <= 3){
                        var imageUrl = post.deskripsi.match(/!\[\]\((.*?)\)/) ? post.deskripsi.match(/!\[\]\((.*?)\)/)[1] : '/default-image.jpg';
                        
                        var parsedDescription = marked.parse(post.deskripsi);
                        var plainTextDescription = stripHtml(parsedDescription).substring(0, 100);

                        var cardHtml = `
                            <div class="col-md-4 p-3">
                                <div class="card h-100 d-flex flex-column">
                                    <img src="${imageUrl}" class="card-img" alt="${post.judul}" style="height: 200px; object-fit: cover;">
                                    <div class="card-body flex-grow-1 d-flex flex-column">
                                        <h4 class="card-title">${post.judul}</h4>
                                        <p class="card-text">${plainTextDescription}...</p>
                                        <a href="/berita/${post.id}" class="btn btn-primary mt-auto">Detail</a>
                                    </div>
                                </div>
                            </div>
                        `
                        $('#berita').append(cardHtml);
                    }
                    index++;
                });

                var buttonBerita = `
                    <div class="row mb-3">
                        <div class="col-12 text-center">
                            <a href="/berita" class="">Berita Selengkapnya</a>
                        </div>
                    </div>

                `;
                $('#berita').append(buttonBerita);


                $('#visiMisi').empty();
                $('#akreditasi').empty();
                dataVisiMisi.forEach(function(post) {
                    var htmlContent = marked.parse(post.deskripsi);
                    $('#visiMisi').html(htmlContent);

                    // Tambahkan kelas img-fluid dan text-center ke semua gambar di dalam #content
                    $('#visiMisi img').addClass('img-fluid').parent().addClass('text-center');
                    $('#visiMisi h4, #visiMisi h3, #visiMisi h2 ').addClass('text-center');

                    // Tambahkan atribut target="_blank" ke semua link di dalam #visiMisi
                    $('#visiMisi a').attr('target', '_blank');
                });
                dataAkreditasi.forEach(function(post) {
                    var htmlContent = marked.parse(post.deskripsi);
                    $('#akreditasi').html(htmlContent);

                    // Tambahkan kelas img-fluid dan text-center ke semua gambar di dalam #content
                    $('#akreditasi img').addClass('img-fluid').parent().addClass('text-center');
                    $('#akreditasi h6').addClass('text-center');

                    // Tambahkan atribut target="_blank" ke semua link di dalam #akreditasi
                    $('#akreditasi a').attr('target', '_blank');
                });

                $('#fasilitas').empty();
                var index = 1;
                dataFasilitas.forEach(function(post) {
                    if(index <= 3){
                        var imageUrl = post.deskripsi.match(/!\[\]\((.*?)\)/) ? post.deskripsi.match(/!\[\]\((.*?)\)/)[1] : '/default-image.jpg';
    
                        var cardHtml = `
                            <div class="col-md-4 mb-3 px-4">
                                <div class="card">
                                    <img src="${imageUrl}" class="card-img" alt="${post.judul}" style="height: 200px;">
                                </div>
                                <h5 class="text-center mt-2">${post.judul}</h5>
                            </div>
                        `;
                        $('#fasilitas').append(cardHtml);
                        index++;
                    }
                });
                var buttonFasilitas = `
                    <div class="row mb-1">
                        <div class="col-12 text-center">
                            <a href="/fasilitas" class="">Lihat Selengkapnya</a>
                        </div>
                    </div>

                `;
                $('#fasilitas').append(buttonFasilitas);

            },
            error: function(xhr, status, error) {
                console.error('There was a problem with the AJAX request:', error);
            }
        });
    });
</script>

@endsection
