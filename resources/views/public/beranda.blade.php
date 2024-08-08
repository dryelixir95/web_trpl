@extends('public.app')
@section('content')
    <!-- Hero Section -->
    <div class="hero-section bg-primary">
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

    <div class="learning-section mt-4">
        <div class="container">
            <h2 class="text-center"><b>Berita Terbaru</b></h2>
            <div class="row" id="berita">

            </div>
        </div>
    </div>

    <div class="learning-section mt-2 mb-4">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="text-center"><b>Visi TRPL</b></h2>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                    
                    <h2 class="text-center"><b>Misi TRPL</b></h2>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/300" class="card-img-top mt-4" alt="Akreditasi" style="margin:auto; height: 200px; width: 300px; object-fit: cover;">
                        <div class="card-body">
                            <hr>
                            <h5 class="card-title text-center">Akreditasi</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="learning-section mt-3">
        <div class="container">
            <h2 class="text-center mb-3"><b>Fasilitas</b></h2>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <img src="https://via.placeholder.com/300" class="card-img-top" alt="Lab 1" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Lab. 1</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <img src="https://via.placeholder.com/300" class="card-img-top" alt="Lab 2" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Lab. 2</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <img src="https://via.placeholder.com/300" class="card-img-top" alt="Lab 3" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Lab. 3</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    $(document).ready(function() {
        $.ajax({
            url: '/api/public/beranda', 
            method: 'GET',
            success: function(data) {
                var dataBerita = data.kategori.filter(kategori => kategori.nama == 'Berita')[0].post;
                var dataFasilitas = data.kategori.filter(kategori => kategori.nama == 'Fasilitas')[0].post;
                var dataAkreditasi = data.kategori.filter(kategori => kategori.nama == 'Akreditasi')[0].post;
                var dataVisiMisi = data.kategori.filter(kategori => kategori.nama == 'Visi Misi Tujuan TRPL')[0].post;
                var dataKerjasamaMitra = data.kategori.filter(kategori => kategori.nama == 'Kerjasama Mitra')[0].post;

                $('#berita').empty();
                var index = 1;
                dataBerita.forEach(function(post) {
                    if(index <= 3){
                        console.log(index)
                        var cardHtml = `
                            <div class="col-md-4 p-3">
                                <div class="card">
                                    <img src="${post.deskripsi.match(/!\[\]\((.*?)\)/) ? post.deskripsi.match(/!\[\]\((.*?)\)/)[1] : '/default-image.jpg'}" class="card-img-top" alt="${post.judul}" style="height: 200px; object-fit: cover;">
                                    <div class="card-body">
                                        <h4 class="card-title">${post.judul}</h4>
                                        <p class="card-text">${post.deskripsi.replace(/!\[\]\((.*?)\)/, '').substring(0, 100)}...</p>
                                        <a href="/berita/${post.id}" class="btn btn-primary">Detail</a>
                                    </div>
                                </div>
                            </div>
                        `
                        $('#berita').append(cardHtml);
                    }
                    index++;
                });

                var buttonBerita = `
                    <div class="row mb-4">
                        <div class="col-12 text-center">
                            <a href="/berita" class="">Berita Selengkapnya</a>
                        </div>
                    </div>

                `;
                $('#berita').append(buttonBerita);

            },
            error: function(xhr, status, error) {
                console.error('There was a problem with the AJAX request:', error);
            }
        });
    });
</script>

@endsection
