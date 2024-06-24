@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Daftar Kerjasama Mitra</h4>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('kerjasama_mitra.create')}}"class="btn btn-primary">Tambah Kerjasama Mitra</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Mitra</th>
                                    <th>Logo Mitra</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="table-mitra">
                                <!-- data mitra -->
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
            url: '/api/admin/kerjasama-mitra',
            method: 'GET',
            success: function(data) {
                if (Array.isArray(data.mitras)) {
                    var tableBody = $('#table-mitra');

                    var index = 1;
                    // Iterasi setiap mitra dalam data
                    data.mitras.forEach(function(mitra) {
                        // Buat baris tabel baru
                        var row = $('<tr></tr>');

                        // Tambahkan data kolom
                        row.append('<td>' + index  + '</td>');
                        row.append('<td>' + mitra.nama_mitra + '</td>');
                        
                        var imagePath = '/images/mitra/' + mitra.logo_mitra;
                        row.append('<td><img src="' + imagePath + '" alt="' + mitra.gambar + '" style="width: 70px; height: auto; border-radius: 0;"></td>');
                        row.append('<td>' + mitra.alamat_mitra + '</td>');

                        row.append('<td><a href="#" class="mr-1 btn btn-primary">Edit</a><button data-id="' + mitra.mitra_id + '" class="btn btn-danger delete-button">Delete</button></td>');
                        // Tambahkan baris ke dalam tabel
                        tableBody.append(row);

                        index++;
                    });

                    $('.delete-button').on('click', function() {
                    var mitraId = $(this).data('id');
                    deleteFasilitas(mitraId);
                });
                }
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });

        function deleteFasilitas(mitraId) {
        if (confirm('Apa Anda yakin ingin menghapus mitra ini?')) {
            $.ajax({
                url: '/api/admin/kerjasama-mitra/' + mitraId,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        alert('Mitra deleted successfully');
                        // Remove the Mitra row from the table
                        $('button[data-id="' + mitraId + '"]').closest('tr').remove();
                    } else {
                        alert('Failed to delete Mitra');
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