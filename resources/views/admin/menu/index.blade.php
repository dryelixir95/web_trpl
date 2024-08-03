@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title" id="card-title"></h4>
                        </div>
                        @if(Auth::user()->role == 'Admin')
                        <div class="col-6 text-end">
                            <a href=""class="btn btn-primary" id="tambah-submenu">Add Kategori</a>
                        </div>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Child Menu</th>
                                    <th>Data Kategori</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="table-kategori">
                                <!-- data menu -->
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
        var kategoriMenu = window.location.pathname.split('/').pop();

        var formattedTitle = kategoriMenu.split('-').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');

        $('.card-title').text('kategori '+formattedTitle);

        $('#tambah-submenu').click(function(event) {
            event.preventDefault();
            var url = '/admin/' + kategoriMenu + '/add';
            // Mengarahkan pengguna ke URL yang sesuai
            window.location.href = url;
        });

        $.ajax({
            url: '/api/admin/kategori-post/data/'+ kategoriMenu,
            method: 'GET',
            success: function(data) {
                if (Array.isArray(data.kategori)) {
                    var tableBody = $('#table-kategori');

                    // Iterasi setiap user dalam data
                    data.kategori.forEach(function(kategori) {

                        var nama_subMenu = kategori.nama.toLowerCase().replace(/\s+/g, '-');
                        // Buat baris tabel baru
                        var row = $('<tr></tr>');

                        // Tambahkan data kolom
                        row.append('<td>' + kategori.nama + '</td>');
                        data.menu.forEach(function(menu) {
                            if(menu.id == kategori.index_menu){
                                row.append('<td id="'+kategori.index_menu+'">' +menu.nama_menu + '</td>');
                            }
                        });
                        var url;
                        data.menu.forEach(function(menu) {
                            if(kategori.type_halaman == 'multi-artikel'){
                                url='/admin/post';
                            } else{
                                url='/admin/halaman';
                            }
                        });
                        row.append('<td><a href=" '+url+'" class="btn btn-primary">Detail</a></td>');
                        row.append('<td><a href="/admin/'+ kategoriMenu +'/edit/'+kategori.id+'" class="mr-1 btn btn-primary">Edit</a><button data-id="' + kategori.id + '" class="btn btn-danger delete-button">Delete</button></td>');
                        // Tambahkan baris ke dalam tabel
                        tableBody.append(row);
                    });

                    $('.delete-button').on('click', function() {
                        var kategoriID = $(this).data('id');
                        deleteMenu(kategoriID);
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });

        function deleteMenu(kategoriID) {
            if (confirm('Apa Anda yakin ingin menghapus kategori ini?')) {
                $.ajax({
                url: '/api/admin/kategori-post/'+ kategoriID,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        alert('kategori deleted successfully');
                        // Remove the kategori row from the table
                        $('button[data-id="' + kategoriID + '"]').closest('tr').remove();
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