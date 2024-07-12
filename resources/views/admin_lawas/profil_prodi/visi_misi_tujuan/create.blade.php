@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Visi, Misi, & Tujuan</h4>
                        <form id="StoreForm" enctype="multipart/form-data" method="POST">
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
        $('#StoreForm').submit(function(event) {
            event.preventDefault(); 

            var formData = new FormData();
            formData.append('isi_visi', $('#isi_visi').val());
            formData.append('isi_misi', $('#isi_misi').val());
            formData.append('isi_tujuan', $('#isi_tujuan').val());

            console.log(formData);

            $.ajax({
                url: '/api/admin/visi-misi-tujuan',
                method: 'POST',
                contentType: 'application/json',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(data) {
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
