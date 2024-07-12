@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Menu</h4>
                    <form id="updateForm" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-sm-12 mb-3">
                                <label for="nama_menu" class="form-label">Nama Menu</label>
                                <input type="text" class="form-control" id="nama_menu" name="nama_menu" required disabled>
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3">
                                <label for="hak_akses" class="form-label">Hak Akses</label>
                                <div id="hak_akses">
                                    <div class="form-check">
                                        <input class="form-check-input m-1" type="checkbox" id="hak_akses_admin" value="Admin" checked disabled>
                                        <label class="form-check-label" for="hak_akses_admin">
                                            Admin
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input m-1" type="checkbox" id="hak_akses_kaprodi" value="Kaprodi">
                                        <label class="form-check-label" for="hak_akses_kaprodi">
                                            Kaprodi
                                        </label>
                                    </div>
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
        var menuId = window.location.pathname.split('/').pop();

        $.ajax({
        url: '/api/admin/menu/' +menuId, // Sesuaikan URL API Anda
        method: 'GET',
        success: function(data) {
            if(data.status === "success") {
                $('#nama_menu').val(data.menu.nama_menu);

                if(data.menu.hak_akses == '2'){
                    $('#hak_akses_kaprodi').prop('checked', true);
                }
            }
        },
        error: function(xhr, status, error) {
            console.error('There has been a problem with your AJAX operation:', error);
        }
    });

        $('#updateForm').submit(function(event) {
            event.preventDefault(); 

            // $('#submitButton').prop('disabled', true);

            var formData = new FormData();
            formData.append('nama_menu', $('#nama_menu').val());

            $('#hak_akses input[type="checkbox"]:checked').each(function() {
                formData.append('hak_akses[]', $(this).val());
            });

            console.log(formData);

            $.ajax({
                url: '/api/admin/menu/'+ menuId,
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
        });
    });
</script>
@endsection
