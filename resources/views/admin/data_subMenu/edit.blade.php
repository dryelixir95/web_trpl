@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit User</h4>
                    <form id="UpdateForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" disabled>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                                <small>Leave blank if you don't want to change the password</small>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                <div id="passwordError" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-control" id="role" name="role" disabled>
                                    <option value="Admin">Admin</option>
                                    <option value="Kaprodi">Kaprodi</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Mendapatkan user ID dari URL
    var userId = window.location.pathname.split('/').pop();

    // Melakukan AJAX request untuk mendapatkan data user
    $.ajax({
        url: '/api/admin/user/edit/' + userId, // Sesuaikan URL API Anda
        method: 'GET',
        success: function(data) {
            if(data.status === "success") {
                var user = data.user;
                $('#name').val(user.name);
                $('#email').val(user.email);
                $('#role').val(user.role);
            }
        },
        error: function(xhr, status, error) {
            console.error('There has been a problem with your AJAX operation:', error);
        }
    });

    // Menangani form submission
    $('#UpdateForm').on('submit', function(event) {
        event.preventDefault();

        var formData = {
            name: $('#name').val(),
            email: $('#email').val(),
            password: $('#password').val(),
            password_confirmation: $('#password_confirmation').val(),
            role: $('#role').val()
        };

        $.ajax({
            url: '/api/admin/user/' + userId,
            method: 'PUT',
            data: formData,
            headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            success: function(response) {
                if(response.status === "success") {
                    alert('User updated successfully');
                    window.location.href = data.url;
                } else {
                    alert('Failed to update user');
                }
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });
    });
});
</script>
@endsection
