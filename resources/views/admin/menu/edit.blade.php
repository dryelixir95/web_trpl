@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Kategori Post</h4>
                    <form id="updateForm" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="nama" class="form-label">Nama Kategori</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" required>
                                <small class="form-text" style="color: red;">tidak boleh ada spasi</small>
                            </div>
                        </div>
                        <input type="text" class="form-control" id="index-menu" name="index-menu" hidden>
                        <input type="text" class="form-control" id="type-halaman" name="type-halaman" hidden>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="deskripsi" class="form-label">deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <button type="submit" class="btn btn-primary" id="submitButton">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        var kategoriPostId = window.location.pathname.split('/').pop();

        $.ajax({
            url: '/api/admin/kategori-post/edit/' + kategoriPostId,
            method: 'GET',
            success: function(data) {
                $('#nama').val(data.kategori.nama);
                $('#slug').val(data.kategori.slug);
                $('#index-menu').val(data.kategori.index_menu);
                $('#type-halaman').val(data.kategori.type_halaman);
                $('#deskripsi').val(data.kategori.deskripsi);
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });

        $('#updateForm').submit(function(event) {
            event.preventDefault(); 

            var formData = new FormData();
            formData.append('nama', $('#nama').val());
            formData.append('slug', $('#slug').val());
            formData.append('index_menu', $('#index-menu').val());
            formData.append('type_halaman', $('#type-halaman').val());
            formData.append('deskripsi', $('#deskripsi').val());

            $.ajax({
                url: '/api/admin/kategori-post/'+kategoriPostId,
                method: 'POST',
                contentType: 'application/json',
                data: formData,
                processData: false,
                contentType: false, 
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-HTTP-Method-Override': 'PUT'
                },
                success: function(data) {
                    console.log(data);
                    window.location.href = data.url;
                },
                error: function(xhr, status, error) {
                    console.error('There has been a problem with your AJAX operation:', error);
                },
            });
        });
    });
</script>
@endsection
