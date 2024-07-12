@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Kegiatan</h4>
                        <form id="EditForm" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                                <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="10" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="gambar" class="form-label">Unggah Gambar</label>
                                <input type="file" class="form-control-file" id="gambar" name="gambar" accept=".jpg,.jpeg,.png">
                                <small id="fileHelp" class="form-text text-muted">File harus berupa gambar (jpg, jpeg, png)</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <div id="preview-container" class="border p-2 d-none">
                                    <h6>Preview File:</h6>
                                    <div id="file-preview"></div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        var kegiatanId = window.location.pathname.split('/').pop();

        $.ajax({
            url: '/api/admin/kegiatan/edit/' + kegiatanId,
            method: 'GET',
            success: function(data) {
                // Isi nilai input form dengan data yang diambil dari API
                $('#nama_kegiatan').val(data.kegiatan.nama_kegiatan);
                $('#keterangan').val(data.kegiatan.keterangan);
                // Tampilkan preview gambar jika ada
                if (data.kegiatan.gambar) {
                    var previewHtml = '<img src="/images/kegiatan/' + data.kegiatan.gambar + '" class="img-fluid">';
                    $('#file-preview').html(previewHtml);
                    $('#preview-container').removeClass('d-none'); // Tampilkan preview container
                }
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });

        // Fungsi untuk menampilkan preview file
        function previewFile(file) {
            var reader = new FileReader();
            reader.onload = function(event) {
                var fileType = file.type.split('/')[0];
                var previewHtml = '';
                if (fileType === 'image') {
                    previewHtml = '<img src="' + event.target.result + '" class="img-fluid">';
                }
                $('#file-preview').html(previewHtml);
                $('#preview-container').removeClass('d-none'); // Tampilkan preview container
            };
            reader.readAsDataURL(file);
        }

        // Event listener saat input gambar berubah
        $('#gambar').change(function() {
            var file = this.files[0];
            previewFile(file); // Panggil fungsi previewFile saat file dipilih
        });

        // Tangani submit form edit
        $('#EditForm').submit(function(event) {
            event.preventDefault(); 

            var formData = new FormData();
            formData.append('nama_kegiatan', $('#nama_kegiatan').val());
            formData.append('keterangan', $('#keterangan').val());
            
            if ($('#gambar')[0].files[0]) {
                formData.append('gambar', $('#gambar')[0].files[0]);
            }

            $.ajax({
                url: '/api/admin/kegiatan/' + kegiatanId,
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
