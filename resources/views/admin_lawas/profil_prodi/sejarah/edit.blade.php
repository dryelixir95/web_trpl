@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Sejarah</h4>
                        <form id="EditForm" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col mb-3">
                                <label for="isi_sejarah" class="form-label">Isi Sejarah</label>
                                <textarea class="form-control" id="isi_sejarah" name="isi_sejarah" rows="10" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="gambar" class="form-label">Unggah Gambar</label>
                                <input type="file" class="form-control-file" id="gambar" name="gambar" accept=".jpg,.jpeg,.png,">
                                <small id="fileHelp" class="form-text text-muted">File harus berupa gambar (jpg, jpeg, png)</small>
                            </div>
                            <div class="col-6 mt-3 text-end">
                                <a href="#"class="btn btn-danger d-none" id="btn-hapus-gambar">Hapus Gambar</a>
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
        $.ajax({
            url: '/api/admin/sejarah/edit/',
            method: 'GET',
            success: function(data) {
                // Isi nilai input form dengan data yang diambil dari API
                $('#isi_sejarah').val(data.sejarah.isi_sejarah);

                // Tampilkan preview gambar jika ada
                if (data.sejarah.gambar) {
                    var previewHtml = '<img src="/images/sejarah/' + data.sejarah.gambar + '" class="img-fluid">';
                    $('#file-preview').html(previewHtml);
                    $('#preview-container').removeClass('d-none'); // Tampilkan preview container
                    $('#btn-hapus-gambar').removeClass('d-none');
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
                $('#btn-hapus-gambar').removeClass('d-none');
            };
            reader.readAsDataURL(file);
        }

        // Event listener saat input gambar berubah
        $('#gambar').change(function() {
            var file = this.files[0];
            previewFile(file); // Panggil fungsi previewFile saat file dipilih
        });

        $('#btn-hapus-gambar').on('click', function() {
            if (confirm('Apa Anda yakin ingin menghapus gambar ini?')) {
            $.ajax({
                url: '/api/admin/sejarah-gambar',
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        alert('Gambar deleted successfully');
                        // Remove the Gambar row from the table
                        $('#preview-container').addClass('d-none');
                        $('#btn-hapus-gambar').addClass('d-none');
                        $('#gambar').val(null);
                    } else {
                        alert('Failed to delete Gambar');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('There has been a problem with your AJAX operation:', error);
                }
            });
        }
        });

        // Tangani submit form edit
        $('#EditForm').submit(function(event) {
            event.preventDefault(); 

            var formData = new FormData();
            formData.append('isi_sejarah', $('#isi_sejarah').val());
            
            if ($('#gambar')[0].files[0]) {
                formData.append('gambar', $('#gambar')[0].files[0]);
            }

            $.ajax({
                url: '/api/admin/sejarah/',
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
