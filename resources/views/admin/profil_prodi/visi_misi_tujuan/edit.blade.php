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
                                <label for="isi_visi" class="form-label">Isi Visi:</label>
                                <textarea class="form-control" id="isi_visi" name="isi_visi" rows="10" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="isi_misi" class="form-label">Isi Misi:</label>
                                <textarea class="form-control" id="isi_misi" name="isi_misi" rows="10" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="isi_tujuan" class="form-label">Isi Tujuan:</label>
                                <textarea class="form-control" id="isi_tujuan" name="isi_tujuan" rows="10" required></textarea>
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
            url: '/api/admin/visi-misi-tujuan/edit',
            method: 'GET',
            success: function(data) {
                // Isi nilai input form dengan data yang diambil dari API
                $('#isi_visi').val(data.vmt.isi_visi);
                $('#isi_misi').val(data.vmt.isi_misi);
                $('#isi_tujuan').val(data.vmt.isi_tujuan);
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });

        // Tangani submit form edit
        $('#EditForm').submit(function(event) {
            event.preventDefault(); 
            
            var formData = new FormData();
            formData.append('isi_visi', $('#isi_visi').val());
            formData.append('isi_misi', $('#isi_misi').val());
            formData.append('isi_tujuan', $('#isi_tujuan').val());

            $.ajax({
                url: '/api/admin/visi-misi-tujuan/',
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
