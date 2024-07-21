@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title" id="card-title"></h4>
                    <form id="updateForm" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-sm-12 mb-3">
                                <label for="nama_menu" class="form-label">Nama Sub Menu</label>
                                <input type="text" class="form-control" id="nama_menu" name="nama_menu" required>
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3">
                                
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
        var kategori = window.location.pathname.split('/')[2];
        var subMenuId = window.location.pathname.split('/').pop();

        var formattedTitle = kategori.split('-').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');

        $('.card-title').text('Edit ' +formattedTitle);

        $.ajax({
            url: '/api/admin/' + kategori +'/'+ subMenuId,
            method: 'GET',
            success: function(data) {
                if(data.status === "success") {
                    $('#nama_menu').val(data.submenu.nama_menu);
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

            console.log(formData);

            $.ajax({
                url: '/api/admin/' + kategori +'/'+ subMenuId,
                method: 'POST',
                contentType: 'application/json',
                data: formData,
                processData: false,
                contentType: false, 
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-HTTP-Method-Override': 'PUT',
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
