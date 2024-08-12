@extends('admin.layouts.app')
@section('content')
<style>
    .selected-tags-container {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        min-height: 46px;
        border: 1px solid #ced4da;
        border-radius: 5px;
        padding: 5px;
    }
    .selected-tag-tag  {
        display: inline-block;
        background-color: #007bff;
        color: white;
        padding: 10px 10px;
        border-radius: 5px;
        margin-right: 5px;
        margin-bottom: 15px;
        margin-top: -9px;
    }

    .selected-tag-tag .remove-tag {
        margin-left: 10px;
        cursor: pointer;
        font-weight: bold;
    }
</style>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Halaman Baru</h4>
                    <form id="StoreForm" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" class="form-control" id="judul" name="judul" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-4">
                                <label for="kategori-post" class="form-label">Kategori</label>
                                <select class="custom-select" style="height: 46px;" id="kategori-post" name="kategori-post">
                                    <option value="">Pilih Kategori</option>
                                    <!-- option -->
                                </select>
                            </div>
                        </div>
                        <div class="row" id="contentContainer">
                            <div class="col mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi/isi</label>
                                <!-- <textarea class="form-control" id="editor" name="keterangan" rows="10"></textarea> -->
                            </div>
                        </div>                        
                        <div class="row">
                            <div class="col-12 mb-3">
                                <button type="submit" class="btn btn-primary" id="submitButton">Simpan</button>
                                <button type="submit" class="btn btn-success" id="uploadButton" style="display: none;">Perbarui</button>
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
        const today = new Date().toISOString().split('T')[0];
        $('#tanggal').val(today);

        $.ajax({
            url: '/api/admin/kategori-post',
            method: 'GET',
            success: function(data) {
                var isAdmin = data.isAdmin;
                var selectMenu = $('#kategori-post');

                if (Array.isArray(data.kategori)) {
                    // Clear existing options
                    selectMenu.empty();

                    // Iterate over each category
                    data.kategori.forEach(function(kategori) {
                        if (kategori.type_halaman == 'single-artikel') {
                            // Show all categories if admin, otherwise filter by beranda == 1
                            if (isAdmin || kategori.beranda == 1) {
                                var option = $('<option></option>').val(kategori.id).text(kategori.nama);
                                selectMenu.append(option);
                            }
                        }
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });

        $('#submitButton').on('click', function(event) {
            event.preventDefault();
            handleFormSubmit('POST', '/api/admin/post');
        });

        // Menambahkan event listener untuk tombol Update
        $('#uploadButton').on('click', function(event) {
            event.preventDefault();
            var kategoriId = window.selectedKategori.id; 

            $.ajax({
                url: `/api/admin/post/${kategoriId}/artikel`,
                method: 'GET',
                success: function(data) {
                    var dataId = data.post.id;
                    handleFormSubmit('PUT', `/api/admin/post/${dataId}`);

                },
                error: function(xhr, status, error) {
                    console.error('There has been a problem with your AJAX operation:', error);
                }
            });
        });

        function handleFormSubmit(method, url) {
            var formData = new FormData();
            formData.append('judul', $('#judul').val());
            formData.append('tanggal', $('#tanggal').val());
            formData.append('kategori', $('#kategori-post').val());

            const editorData = window.editor.getData();
            formData.append('deskripsi', editorData); // Ambil data CKEditor

            if(method == 'POST'){
                $.ajax({
                    url: url,
                    method: method,
                    data: formData,
                    processData: false,
                    contentType: false, 
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        console.log(data);
                        window.location.href = data.url;
                    },
                    error: function(xhr, status, error) {
                        console.error('There has been a problem with your AJAX operation:', error);
                    },
                });
            } else{
                $.ajax({
                    url: url,
                    method: 'POST',
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
            }      
        }
    });
</script>
@endsection
