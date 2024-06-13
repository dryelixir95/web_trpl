@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Daftar Fasilitas</h4>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('fasilitas.create')}}"class="btn btn-primary">Tambah Fasilitas</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Fasilitas</th>
                                    <th>Gambar</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="table-fasilitas">
                                <!-- data fasilitas -->
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
            url: '/api/admin/fasilitas',
            method: 'GET',
            success: function(data) {
                if (Array.isArray(data.fasilitas)) {
                    var tableBody = $('#table-fasilitas');

                    var index = 1;
                    // Iterasi setiap user dalam data
                    data.fasilitas.forEach(function(fasilitas) {
                        // Buat baris tabel baru
                        var row = $('<tr></tr>');

                        // Tambahkan data kolom
                        row.append('<td>' + index  + '</td>');
                        row.append('<td>' + fasilitas.nama_fasilitas + '</td>');
                        
                        var imagePath = '/images/fasilitas/' + fasilitas.gambar;
                        row.append('<td><img src="' + imagePath + '" alt="' + fasilitas.gambar + '" style="width: 70px; height: auto; border-radius: 0;"></td>');
                        row.append('<td>' + fasilitas.keterangan + '</td>');

                        row.append('<td><a href="'+ '/admin/fasilitas/edit/' + fasilitas.fasilitas_id + '" class="mr-1 btn btn-primary">Edit</a><button data-id="' + fasilitas.fasilitas_id + '" class="btn btn-danger delete-button">Delete</button></td>');
                        // Tambahkan baris ke dalam tabel
                        tableBody.append(row);

                        index++;
                    });

                    $('.delete-button').on('click', function() {
                    var fasilitasId = $(this).data('id');
                    deleteFasilitas(fasilitasId);
                });
                }
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });

        function deleteFasilitas(fasilitasId) {
        if (confirm('Apa Anda yakin ingin menghapus Fasilitas ini?')) {
            $.ajax({
                url: '/api/admin/fasilitas/' + fasilitasId,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        alert('Fasilitas deleted successfully');
                        // Remove the Fasilitas row from the table
                        $('button[data-id="' + fasilitasId + '"]').closest('tr').remove();
                    } else {
                        alert('Failed to delete Fasilitas');
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