@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Dokumen TA Baru</h4>
                        <form id="StoreForm" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nama_file_ta" class="form-label">Nama Dokumen TA</label>
                                <input type="text" class="form-control" id="nama_file_ta" name="nama_file_ta" required>
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
                                <label for="file_ta" class="form-label">Unggah file PDF/XLS</label>
                                <input type="file" class="form-control-file" id="file_ta" name="file_ta" accept=".xls,.xlsx,.pdf" required>
                                <small id="fileHelp" class="form-text text-muted">File harus berupa PDF/XLS.</small>
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
                if (fileType === 'application' && file.type === 'application/pdf') {
                    previewHtml = '<embed src="' + event.target.result + '" type="application/pdf" width="100%" height="600px" />';
                }
                $('#file-preview').html(previewHtml);
                $('#preview-container').removeClass('d-none'); // Tampilkan preview container
            };
            reader.readAsDataURL(file);
        }

        $('#file_ta').change(function() {
            var file = this.files[0];
            previewFile(file); // Panggil fungsi previewFile saat file dipilih
        });

        $('#StoreForm').submit(function(event) {
            event.preventDefault(); 

            var formData = new FormData();
            formData.append('nama_file_ta', $('#nama_file_ta').val());
            formData.append('keterangan', $('#keterangan').val());
            
            if ($('#file_ta')[0].files[0]) {
                formData.append('file_ta', $('#file_ta')[0].files[0]);
            }

            console.log(formData);

            $.ajax({
                url: '/api/admin/tugas-akhir',
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
