@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Daftar Menu</h4>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('menu.create')}}"class="btn btn-primary">Tambah Menu</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="table-menu">
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
        $.ajax({
            url: '/api/admin/menu',
            method: 'GET',
            success: function(data) {
                if (Array.isArray(data.menu)) {
                    var tableBody = $('#table-menu');

                    // Iterasi setiap user dalam data
                    data.menu.forEach(function(menu) {
                        // Buat baris tabel baru
                        var row = $('<tr></tr>');

                        // Tambahkan data kolom
                        row.append('<td>' + menu.nama_menu + '</td>');
                        row.append('<td><a href="'+ '/admin/menu/edit/' + menu.id + '" class="mr-1 btn btn-primary">Edit</a><button data-id="' + menu.id + '" class="btn btn-danger delete-button">Delete</button></td>');
                        // Tambahkan baris ke dalam tabel
                        tableBody.append(row);
                    });

                    $('.delete-button').on('click', function() {
                    var menuId = $(this).data('id');
                    deleteMenu(menuId);
                });
                }
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });

        function deleteMenu(menuId) {
            if (confirm('Apa Anda yakin ingin menghapus Menu ini?')) {
                $.ajax({
                url: '/api/admin/menu/' + menuId,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        alert('Menu deleted successfully');
                        // Remove the Menu row from the table
                        $('button[data-id="' + menuId + '"]').closest('tr').remove();
                        $('li[data-id="' + menuId + '"]').remove();
                    } else {
                        alert('Failed to delete menu');
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