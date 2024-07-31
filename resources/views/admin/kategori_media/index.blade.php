@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Daftar Kategori Media</h4>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('kategori-media.create')}}"class="btn btn-primary">Tambah Kategori</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Kategori</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="table-kategori-media">
                                <!-- data media -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function () {
        $.ajax({
            url: '/api/admin/kategori-media',
            method: 'GET',
            success: function(data) {
                if (Array.isArray(data.kategori)) {
                    var tableBody = $('#table-kategori-media');

                    // Iterasi setiap user dalam data
                    data.kategori.forEach(function(media) {
                        // Buat baris tabel baru
                        var row = $('<tr></tr>');

                        // Tambahkan data kolom
                        row.append('<td>' + media.nama + '</td>');
                        row.append('<td><button data-id="' + media.id + '" class="btn btn-danger delete-button">Delete</button></td>');
                        // Tambahkan baris ke dalam tabel
                        tableBody.append(row);
                    });

                    $('.delete-button').on('click', function() {
                    var mediaId = $(this).data('id');
                    deleteMedia(mediaId);
                });
                }
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });

        function deleteMedia(mediaId) {
            if (confirm('Apa Anda yakin ingin menghapus kategori media ini?')) {
                $.ajax({
                url: '/api/admin/kategori-media/' + mediaId,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        alert('Media deleted successfully');
                        // Remove the media row from the table
                        $('button[data-id="' + mediaId + '"]').closest('tr').remove();
                    } else {
                        alert('Failed to delete media');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('There has been a problem with your AJAX operation:', error);
                }
            });
        }
    }
    });
</script>

@endsection