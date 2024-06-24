@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Akreditasi</h4>
                        <form id="UpdateForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" class="form-control" id="judul" name="judul" disabled>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="tanggal" class="form-label">tanggal Akreditasi</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="file_akreditasi" class="form-label">Unggah Gambar atau PDF</label>
                                <input type="file" class="form-control-file" id="file_akreditasi" name="file_akreditasi" accept=".jpg,.jpeg,.png,.pdf">
                                <small id="fileHelp" class="form-text text-muted">File harus berupa gambar (jpg, jpeg, png) atau PDF.</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <div id="preview-container" class="border p-2 d-none">
                                    <h6 class="text-center">Preview File:</h6>
                                    <div id="file-preview"></div>
                                </div>
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
    // Melakukan AJAX request untuk mendapatkan data user
    $.ajax({
        url: '/api/admin/akreditasi', // Sesuaikan URL API Anda
        method: 'GET',
        success: function(data) {
            if(data.status === "success") {
                var akreditasi = data.akreditasis;

                $('#judul').val(akreditasi.judul);
                $('#tanggal').val(akreditasi.tgl_akreditasi);
                // $('#file_akreditasi').val(akreditasi.file_akreditasi);

                var fileUrl = akreditasi.file_akreditasi; // URL file
                var filePreview = $('#file-preview');

                // Tentukan tipe file berdasarkan ekstensi
                var fileExtension = fileUrl.split('.').pop().toLowerCase();
                var previewContent = '';

                if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExtension)) {
                    // Jika file gambar, buat elemen img
                    previewContent = '<img src="' + '/files/akreditasi/' + fileUrl + '" alt="Preview" class="img-fluid">';
                } else if (fileExtension === 'pdf') {
                    // Jika file PDF, buat elemen embed
                    previewContent = '<embed src="' + '/files/akreditasi/' + fileUrl + '" type="application/pdf" width="100%" height="400px">';
                } else {
                    // Jika file tipe lain, buat link untuk mengunduh
                    previewContent = '<a href="' + '/files/akreditasi/' + fileUrl + '" target="_blank">Lihat File</a>';
                }

                // Tambahkan konten preview ke container
                filePreview.html(previewContent);

                // Tampilkan container preview
                $('#preview-container').removeClass('d-none');
            }
        },
        error: function(xhr, status, error) {
            console.error('There has been a problem with your AJAX operation:', error);
        }
    });

    function previewFile(file) {
        var reader = new FileReader();
        reader.onload = function(event) {
            var fileType = file.type.split('/')[0];
            var previewHtml = '';
            if (fileType === 'image') {
                previewHtml = '<img src="' + event.target.result + '" class="img-fluid">';
            } else if (fileType === 'application' && file.type === 'application/pdf') {
                previewHtml = '<embed src="' + event.target.result + '" type="application/pdf" width="100%" height="600px" />';
            }
            $('#file-preview').html(previewHtml);
            $('#preview-container').removeClass('d-none'); // Tampilkan preview container
        };
        reader.readAsDataURL(file);
    }

    $('#file_akreditasi').change(function() {
        var file = this.files[0];
        previewFile(file); // Panggil fungsi previewFile saat file dipilih
    });

    // Menangani form submission
    $('#UpdateForm').on('submit', function(event) {
        event.preventDefault();

        var formData = new FormData();
        formData.append('judul', $('#judul').val());
        formData.append('tgl_akreditasi', $('#tanggal').val());

        if ($('#file_akreditasi')[0].files.length > 0) {
            formData.append('file_akreditasi', $('#file_akreditasi')[0].files[0]);
        }

        $.ajax({
            url: '/api/admin/akreditasi',
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
                window.location.href = data.url; // Redirect ke halaman setelah berhasil disimpan
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });
    });
});
</script>
@endsection
