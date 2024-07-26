@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Media Baru</h4>
                    <form id="StoreForm" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col mb-3">
                                <label for="media" class="form-label">Unggah Media/File</label>
                                <input type="file" class="form-control-file" id="media" name="media" accept=".jpeg,.png,.jpg,.gif,.svg,.pdf,.doc,.docx,.xls,.xlsx" required>
                                <small id="fileHelp" class="form-text" style="color: red;">File bisa berupa IMG/DOC/PDF/XLS.</small>
                            </div>
                        </div>
  
                        <div class="row">
                            <div class="col-12 mb-3">
                            <label for="kategori" class="form-label">kategori</label>
                            <select class="form-control" id="kategori" name="kategori">
                                    <option value="">Pilih Kategori</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="keterangan" class="form-label">keterangan Media/File</label>
                                <small class="form-text" style="color: red;">bisa tidak di isi</small>
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="10"></textarea>
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
                        <div class="row">
                            <div class="col-12 mb-3">
                                <button type="submit" class="btn btn-primary" id="submitButton">Simpan</button>
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
        function previewFile(file) {
            var reader = new FileReader();
            reader.onload = function(event) {
                var fileType = file.type.split('/')[0];
                var previewHtml = '';
                if (fileType === 'application' && file.type === 'application/pdf') {
                    previewHtml = '<embed src="' + event.target.result + '" type="application/pdf" width="100%" height="600px" />';
                }
                if (fileType === 'image') {
                    previewHtml = '<img src="' + event.target.result + '" class="img-fluid">';
                }
                $('#file-preview').html(previewHtml);
                $('#preview-container').removeClass('d-none'); // Tampilkan preview container
            };
            reader.readAsDataURL(file);
        }

        $('#media').change(function() {
            var file = this.files[0];
            previewFile(file); // Panggil fungsi previewFile saat file dipilih
        });

        $.ajax({
            url: '/api/admin/kategori-media',
            method: 'GET',
            success: function(data) {
                if (Array.isArray(data.kategori)) {
                    var selectMenu = $('#kategori');

                    // Iterasi setiap user dalam data
                    data.kategori.forEach(function(kategori) {
                        // Buat baris tabel baru
                        var option = $('<option></option>').val(kategori.nama).text(kategori.nama);
                        
                        // Tambahkan baris ke dalam tabel
                        selectMenu.append(option);
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });

        $('#StoreForm').submit(function(event) {
            event.preventDefault(); 

            // $('#submitButton').prop('disabled', true);

            var formData = new FormData();
            formData.append('kategori', $('#kategori').val());
            formData.append('keterangan', $('#keterangan').val());
            if ($('#media')[0].files[0]) {
                formData.append('media', $('#media')[0].files[0]);
            }

            $.ajax({
                url: '/api/admin/media',
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
                },
            });
        });
    });
</script>
@endsection
