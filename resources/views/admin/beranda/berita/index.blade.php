@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Daftar Berita</h4>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('berita.create')}}"class="btn btn-primary">Tambah Berita</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>judul berita</th>
                                    <th>Isi Berita</th>
                                    <th>tanggal Berita</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="table-berita">
                                <!-- data berita -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $.ajax({
            url: '/api/admin/berita',
            method: 'GET',
            success: function(data) {
                if (Array.isArray(data.berita)) {
                    var tableBody = $('#table-berita');

                    var index = 1;
                    // Iterasi setiap user dalam data
                    data.berita.forEach(function(berita) {
                        // Buat baris tabel baru
                        var row = $('<tr></tr>');

                        // Tambahkan data kolom
                        row.append('<td>' + index  + '</td>');
                        row.append('<td>' + berita.judul_berita + '</td>');
                        row.append('<td>' + berita.isi_berita + '</td>');
                        row.append('<td>' + berita.tgl_berita + '</td>');
                        
                        var imagePath = '/images/berita/' + berita.gambar;
                        row.append('<td><img src="' + imagePath + '" alt="' + berita.judul_berita + '" style="width: 70px; height: auto; border-radius: 0;"></td>');
                        row.append('<td><a href="'+ '/admin/berita/edit/' + berita.berita_id + '" class="mr-1 btn btn-primary">Edit</a><button data-id="' + berita.berita_id + '" class="btn btn-danger delete-button">Delete</button></td>');
                        // Tambahkan baris ke dalam tabel
                        tableBody.append(row);

                        index++;
                    });

                    $('.delete-button').on('click', function() {
                    var beritaId = $(this).data('id');
                    deleteBerita(beritaId);
                });
                }
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });

        function deleteBerita(beritaId) {
        if (confirm('Apa Anda yakin ingin menghapus berita ini?')) {
            $.ajax({
                url: '/api/admin/berita/' + beritaId,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        alert('Berita deleted successfully');
                        // Remove the Berita row from the table
                        $('button[data-id="' + beritaId + '"]').closest('tr').remove();
                    } else {
                        alert('Failed to delete Berita');
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