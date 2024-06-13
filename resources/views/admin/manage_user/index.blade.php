@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Daftar user</h4>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('user.create')}}"class="btn btn-primary">Tambah User</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="table-user">
                                <!-- data user -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
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
                        row.append('<td>' + user.name + '</td>');
                        row.append('<td>' + user.email + '</td>');
                        row.append('<td><a href="'+ '/admin/user/edit/' + user.id + '" class="mr-1 btn btn-primary">Edit</a><button data-id="' + user.id + '" class="btn btn-danger delete-button">Delete</button></td>');
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