@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Daftar Halaman</h4>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('halaman.create')}}"class="btn btn-primary">Tambah Halaman</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="text-center">
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Deskripsi/Isi</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="table-post">
                                <!-- data post -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function () {
        $.ajax({
            url: '/api/admin/post',
            method: 'GET',
            success: function(data) {
                if (Array.isArray(data.posts)) {
                    var tableBody = $('#table-post');
                    var kategoriMap = {};

                    // Buat peta kategori untuk akses cepat
                    data.kategori.forEach(function(kategori) {
                        kategoriMap[kategori.id] = kategori;
                    });

                    // Iterasi setiap post dalam data
                    data.posts.forEach(function(post) {
                        var kategori = kategoriMap[post.kategori];

                        if (kategori && kategori.type_halaman == 'single-artikel') {
                            // Buat baris tabel baru
                            var row = $('<tr></tr>');

                            // Tambahkan data kolom
                            row.append('<td>' + post.judul + '</td>');

                            row.append('<td>' + kategori.nama + '</td>');

                            var isiDeskripsi = post.deskripsi;
                            var shortenedDeskripsi = isiDeskripsi;
                            var showMore = '';

                            if (isiDeskripsi && isiDeskripsi.length > 70) {
                                shortenedDeskripsi = isiDeskripsi.substring(0, 70) + '...';
                                showMore = '<a href="#" class="show-more">Selengkapnya</a>';
                            }

                            row.append('<td><pre style="white-space: pre-wrap; background:000; font-family: sans-serif; line-height: 1.5;">' + shortenedDeskripsi + ' ' + showMore + '</pre></td>');

                            row.append('<td>' + post.tanggal + '</td>');

                            row.append('<td><a href="'+ '/admin/halaman/edit/' + post.id + '" class="mr-1 btn btn-primary">Edit</a><button data-id="' + post.id + '" class="btn btn-danger delete-button">Delete</button></td>');

                            // Tambahkan baris ke dalam tabel
                            tableBody.append(row);

                            $('.show-more').on('click', function(event) {
                                event.preventDefault();
                                $(this).parent().html(isiDeskripsi);
                            });
                        }
                    });


                    $('.delete-button').on('click', function() {
                        var postId = $(this).data('id');
                        deletePost(postId);
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });

        function deletePost(postId) {
            if (confirm('Apa Anda yakin ingin menghapus Postingan ini?')) {
                $.ajax({
                url: '/api/admin/post/' + postId,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        alert('Postingan deleted successfully');
                        $('button[data-id="' + postId + '"]').closest('tr').remove();
                    } else {
                        alert('Failed to delete Postingan');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('There has been a problem with your AJAX operation:', error);
                }
            });
        }
    }
    });
</script>

@endsection