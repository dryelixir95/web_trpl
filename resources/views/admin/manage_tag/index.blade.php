@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Daftar Tag</h4>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('tag.create')}}"class="btn btn-primary">Tambah Tag</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Tag</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="table-tag">
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
            url: '/api/admin/tag',
            method: 'GET',
            success: function(data) {
                if (Array.isArray(data.tag)) {
                    var tableBody = $('#table-tag');

                    // Iterasi setiap user dalam data
                    data.tag.forEach(function(tag) {
                        // Buat baris tabel baru
                        var row = $('<tr></tr>');

                        // Tambahkan data kolom
                        row.append('<td>' + tag.tag + '</td>');
                        row.append('<td><button data-id="' + tag.id + '" class="btn btn-danger delete-button">Delete</button></td>');
                        // Tambahkan baris ke dalam tabel
                        tableBody.append(row);
                    });

                    $('.delete-button').on('click', function() {
                    var tagId = $(this).data('id');
                    deleteMedia(tagId);
                });
                }
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });

        function deleteMedia(tagId) {
            if (confirm('Apa Anda yakin ingin menghapus kategori media ini?')) {
                $.ajax({
                url: '/api/admin/tag/' + tagId,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        alert('Tag deleted successfully');
                        // Remove the Tag row from the table
                        $('button[data-id="' + tagId + '"]').closest('tr').remove();
                    } else {
                        alert('Failed to delete Tag');
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