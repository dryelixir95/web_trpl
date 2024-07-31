@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Daftar Media</h4>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('media.create')}}"class="btn btn-primary">Add Media</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Media</th>
                                    <th>Kategori</th>
                                    <th>Deskripsi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="table-media">
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
            url: '/api/admin/media',
            method: 'GET',
            success: function(data) {
                if (Array.isArray(data.media)) {
                    var tableBody = $('#table-media');

                    // Iterasi setiap user dalam data
                    data.media.forEach(function(media) {
                        // Buat baris tabel baru
                        var row = $('<tr></tr>');

                        // Tambahkan data kolom
                        
                        var fileUrl = media.media;
                        var fileExtension = fileUrl.split('.').pop().toLowerCase();
                        
                        if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExtension)) {
                            // Jika file gambar, buat elemen img
                            row.append('<td><img src="' + '/media/' + fileUrl + '" alt="' + media.nama + '" style="width: 70px; height: auto; border-radius: 0;"></td>');
                        } else if (fileExtension === 'pdf') {
                            // Jika file PDF, buat link untuk mengunduh
                            row.append('<td><a href="' + '/media/' + fileUrl + '" target="_blank">Lihat File</a></td>');
                        } else{
                            row.append('<td><a href="' + '/media/' + fileUrl + '" target="_blank">Lihat File</a></td>');
                        }
                        row.append('<td>' + media.kategori + '</td>');

                        row.append('<td>' + media.keterangan + '</td>');
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
            if (confirm('Apa Anda yakin ingin menghapus media ini?')) {
                $.ajax({
                url: '/api/admin/media/' + mediaId,
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