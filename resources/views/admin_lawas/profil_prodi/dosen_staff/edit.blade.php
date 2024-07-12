@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Dosen & Staff</h4>
                    <form id="EditForm" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nama" class="form-label">Nama Dosen/Staff</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <textarea class="form-control" id="jabatan" name="jabatan" rows="10" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="foto" class="form-label">Unggah Foto</label>
                                <input type="file" class="form-control-file" id="foto" name="foto" accept=".jpg,.jpeg,.png,">
                                <small id="fileHelp" class="form-text text-muted">File harus berupa Gambar (jpg, jpeg, png)</small>
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
        var dosenStaffId = window.location.pathname.split('/').pop();
        
        function fetchDosenStaff(id) {
            $.ajax({
                url: '/api/admin/dosen-staff/edit/' + id,
                method: 'GET',
                success: function(data) {
                    if(data.status === "success") {
                        $('#nama').val(data.dosenStaff.nama);
                        $('#jabatan').val(data.dosenStaff.jabatan);
                        if (data.dosenStaff.foto) {
                            var previewHtml = '<img src="/images/dosenStaff/' + data.dosenStaff.foto + '" class="img-fluid">';
                            $('#file-preview').html(previewHtml);
                            $('#preview-container').removeClass('d-none');
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error('There has been a problem with your AJAX operation:', error);
                }
            });
        }

        function previewFile(file) {
            var reader = new FileReader();
            reader.onload = function(event) {
                var fileType = file.type.split('/')[0];
                var previewHtml = '';
                if (fileType === 'image') {
                    previewHtml = '<img src="' + event.target.result + '" class="img-fluid">';
                }
                $('#file-preview').html(previewHtml);
                $('#preview-container').removeClass('d-none');
            };
            reader.readAsDataURL(file);
        }

        $('#foto').change(function() {
            var file = this.files[0];
            previewFile(file);
        });

        $('#EditForm').submit(function(event) {
            event.preventDefault();

            var formData = new FormData();
            formData.append('nama', $('#nama').val());
            formData.append('jabatan', $('#jabatan').val());

            if ($('#foto')[0].files[0]) {
                formData.append('foto', $('#foto')[0].files[0]);
            }

            $.ajax({
                url: '/api/admin/dosen-staff/' + dosenStaffId,
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
                }
            });
        });

        fetchDosenStaff(dosenStaffId); // Panggil fungsi fetchDosenStaff saat halaman dimuat
    });
</script>
@endsection
