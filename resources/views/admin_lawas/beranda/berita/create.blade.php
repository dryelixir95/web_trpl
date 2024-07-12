@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Berita Baru</h4>
                        <form id="StoreForm" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="judul_berita" class="form-label">Judul Berita</label>
                                <input type="text" class="form-control" id="judul_berita" name="judul_berita" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="tgl_berita" class="form-label">Tanggal Beita</label>
                                <input type="date" class="form-control" id="tgl_berita" name="tgl_berita" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="isi_berita" class="form-label">Isi Berita</label>
                                <textarea class="form-control" id="isi_berita" name="isi_berita" rows="10" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col mb-3">
                                <label for="gambar" class="form-label">Unggah Gambar</label>
                                <input type="file" class="form-control-file" id="gambar" name="gambar" accept=".jpg,.jpeg,.png,">
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

        $('#gambar').change(function() {
            var file = this.files[0];
            previewFile(file); // Panggil fungsi previewFile saat file dipilih
        });

        $('#StoreForm').submit(function(event) {
            event.preventDefault(); 

            var formData = new FormData();
            formData.append('judul_berita', $('#judul_berita').val());
            formData.append('isi_berita', $('#isi_berita').val());
            formData.append('tgl_berita', $('#tgl_berita').val());
            
            if ($('#gambar')[0].files[0]) {
                formData.append('gambar', $('#gambar')[0].files[0]);
            }

            $.ajax({
                url: '/api/admin/berita',
                method: 'POST',
                contentType: 'application/json',
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
                }
            });
        });
    });
</script>
@endsection
