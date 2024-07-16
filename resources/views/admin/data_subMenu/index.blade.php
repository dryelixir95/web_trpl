@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4 id="card-title" class="card-title"></h4>
                        </div>
                        <div class="col-6 text-end">
                            <a href="#" id="setting-field-submenu" class="btn btn-success">Setting Field Data</a>
                            <a href="#" id="tambah-data-submenu" class="btn btn-primary">Add Data</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead id="table-head">
                                <!-- <tr>
                                    <th>Name</th>
                                    <th>Value</th>
                                    <th>Action</th>
                                </tr> -->
                            </thead>
                            <tbody id="table-body">
                                <!-- data body -->
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
        var kategori = window.location.pathname.split('/')[2];
        var subMenu = window.location.pathname.split('/')[3];

        var formattedTitle = subMenu.split('-').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');

        $('.card-title').text('Daftar '+formattedTitle);

        $('#tambah-data-submenu').click(function(event) {
            event.preventDefault();
            var url = '/admin/' + kategori+'/'+subMenu + '/add';
            // Mengarahkan pengguna ke URL yang sesuai
            window.location.href = url;
        });

        $('#setting-field-submenu').click(function(event) {
            event.preventDefault();
            var url = '/admin/' + kategori+'/'+subMenu + '/field';
            // Mengarahkan pengguna ke URL yang sesuai
            window.location.href = url;
        });

        // field sub-menu
        $.ajax({
            url: '/api/admin/user',
            method: 'GET',
            success: function(data) {
                if (Array.isArray(data.users)) {
                    var tableBody = $('#table-user');

                    // Iterasi setiap user dalam data
                    data.users.forEach(function(user) {
                        // Buat baris tabel baru
                        var row = $('<tr></tr>');

                        // Tambahkan data kolom
                        row.append('<td>visi</td>');
                        row.append('<td>keterangan</td>');
                        row.append('<td><a href="#" class="mr-1 btn btn-primary">Edit</a><button data-id="' + user.id + '" class="btn btn-danger delete-button">Delete</button></td>');
                        // Tambahkan baris ke dalam tabel
                        tableBody.append(row);
                    });

                    $('.delete-button').on('click', function() {
                    var userId = $(this).data('id');
                    deleteUser(userId);
                });
                }
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });

        $.ajax({
            url: '/api/admin/user',
            method: 'GET',
            success: function(data) {
                if (Array.isArray(data.users)) {
                    var tableBody = $('#table-user');

                    // Iterasi setiap user dalam data
                    data.users.forEach(function(user) {
                        // Buat baris tabel baru
                        var row = $('<tr></tr>');

                        // Tambahkan data kolom
                        row.append('<td>visi</td>');
                        row.append('<td>keterangan</td>');
                        row.append('<td><a href="#" class="mr-1 btn btn-primary">Edit</a><button data-id="' + user.id + '" class="btn btn-danger delete-button">Delete</button></td>');
                        // Tambahkan baris ke dalam tabel
                        tableBody.append(row);
                    });

                    $('.delete-button').on('click', function() {
                    var userId = $(this).data('id');
                    deleteUser(userId);
                });
                }
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });

        function deleteUser(userId) {
            if (confirm('Apa Anda yakin ingin menghapus User ini?')) {
                $.ajax({
                url: '/api/admin/user/' + userId,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        alert('User deleted successfully');
                        // Remove the user row from the table
                        $('button[data-id="' + userId + '"]').closest('tr').remove();
                    } else {
                        alert('Failed to delete user');
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