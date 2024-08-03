@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Daftar Kategori Post</h4>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('kategori-post.create')}}"class="btn btn-primary">Add Kategori</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Slug</th>
                                    <th>Index Menu</th>
                                    <th>Deskripsi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="table-kategori-post">
                                <!-- data media -->
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
            url: '/api/admin/kategori-post',
            method: 'GET',
            success: function(data) {
                if (Array.isArray(data.kategori)) {
                    var tableBody = $('#table-kategori-post');

                    // Iterasi setiap user dalam data
                    data.kategori.forEach(function(kategori) {
                        if(kategori.type_halaman == 'multi-artikel'){
                            var row = $('<tr></tr>');

                            // Tambahkan data kolom
                            row.append('<td>' + kategori.nama + '</td>');
                            row.append('<td>' + kategori.slug + '</td>');

                            var menukategori;
                            data.menu.forEach(function(menu) {
                                if(menu.id == kategori.index_menu){
                                    menukategori = '<td id="'+kategori.index_menu+'">' +menu.nama_menu + '</td>';
                                } else if( kategori.index_menu == null){
                                    menukategori = '<td>Beranda</td>';
                                }
                            });
                            row.append(menukategori);

                            row.append('<td>' + kategori.deskripsi + '</td>');
                            row.append('<td><a href="'+ '/admin/kategori-post/edit/' + kategori.id + '" class="mr-1 btn btn-primary">Edit</a><button data-id="' + kategori.id + '" class="btn btn-danger delete-button">Delete</button></td>');
                            // Tambahkan baris ke dalam tabel
                            tableBody.append(row);
                        }
                        // Buat baris tabel baru
                    });

                    $('.delete-button').on('click', function() {
                    var kategoriId = $(this).data('id');
                    deleteMedia(kategoriId);
                });
                }
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });

        function deleteMedia(kategoriId) {
            if (confirm('Apa Anda yakin ingin menghapus kategori media ini?')) {
                $.ajax({
                url: '/api/admin/kategori-post/' + kategoriId,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        alert('Kategori deleted successfully');
                        // Remove the kategori row from the table
                        $('button[data-id="' + kategoriId + '"]').closest('tr').remove();
                    } else {
                        alert('Failed to delete kategori');
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