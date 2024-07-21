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
                        <div class="col-6 text-end">
                            <a href=""class="btn btn-primary" id="tambah-submenu">Add Sub-Menu</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Child Menu</th>
                                    <th>Data Sub-Menu</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="table-submenu">
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
        var kategori = window.location.pathname.split('/').pop();

        var formattedTitle = kategori.split('-').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');

        $('.card-title').text('Sub-Menu '+formattedTitle);

        $('#tambah-submenu').click(function(event) {
            event.preventDefault();
            var url = '/admin/' + kategori + '/add';
            // Mengarahkan pengguna ke URL yang sesuai
            window.location.href = url;
        });
        $.ajax({
            url: '/api/admin/'+ kategori,
            method: 'GET',
            success: function(data) {
                if (Array.isArray(data.subMenu)) {
                    var tableBody = $('#table-submenu');

                    // Iterasi setiap user dalam data
                    data.subMenu.forEach(function(submenu) {

                        var nama_subMenu = submenu.nama_menu.toLowerCase().replace(/\s+/g, '-');
                        // Buat baris tabel baru
                        var row = $('<tr></tr>');

                        // Tambahkan data kolom
                        row.append('<td>' + submenu.nama_menu + '</td>');
                        row.append('<td>' + submenu.kategori + '</td>');
                        row.append('<td><a href="/admin/' + kategori + '/' + nama_subMenu + '" class="btn btn-primary">Detail</a></td>');
                        row.append('<td><a href="/admin/'+ kategori +'/edit/'+submenu.id+'" class="mr-1 btn btn-primary">Edit</a><button data-id="' + submenu.id + '" class="btn btn-danger delete-button">Delete</button></td>');
                        // Tambahkan baris ke dalam tabel
                        tableBody.append(row);
                    });

                    $('.delete-button').on('click', function() {
                        var submenuId = $(this).data('id');
                        deleteMenu(submenuId);
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });

        function deleteMenu(submenuId) {
            if (confirm('Apa Anda yakin ingin menghapus SubMenu ini?')) {
                $.ajax({
                url: '/api/admin/' + kategori +'/'+ submenuId,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        alert('SubMenu deleted successfully');
                        // Remove the Menu row from the table
                        $('button[data-id="' + submenuId + '"]').closest('tr').remove();
                    } else {
                        alert('Failed to delete SubMenu');
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