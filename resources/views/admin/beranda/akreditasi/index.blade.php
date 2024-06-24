@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Akreditasi</h4>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('akreditasi.create')}}" class="btn btn-primary" id="btn-tambah">Tambah</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal</th>
                                    <th>File</th>
                                </tr>
                            </thead>
                            <tbody id="table-akreditasi">
                                <!-- data user -->
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
            url: '/api/admin/akreditasi',
            method: 'GET',
            success: function(data) {
                var tableBody = $('#table-akreditasi');
                    // Buat baris tabel baru
                var row = $('<tr></tr>');

                // Tambahkan data kolom
                row.append('<td></td>');
                row.append('<td>' + data.akreditasis.tgl_akreditasi + '</td>');

                var fileUrl = data.akreditasis.file_akreditasi; // URL file

                // Tentukan tipe file berdasarkan ekstensi
                var fileExtension = fileUrl.split('.').pop().toLowerCase();

                if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExtension)) {
                    // Jika file gambar, buat elemen img
                    row.append('<td><img src="' +  '/files/akreditasi/' + fileUrl  + '" alt="' + data.akreditasis.file_akreditasi + '" style="width: 70px; height: auto; border-radius: 0;"></td>');
                } else if (fileExtension === 'pdf') {
                    // Jika file PDF, buat link untuk mengunduh
                   row.append('<td><a href="' + '/files/akreditasi/' + fileUrl + '" target="_blank">Lihat File</a></td>');
                }

                row.append('<td><a href="/admin/akreditasi/edit "class="mr-1 btn btn-primary">Edit</a></td>');
                
                // Tambahkan baris ke dalam tabel
                tableBody.append(row);

                // Tampilkan tombol "Tambah" jika tidak ada data
                $('#btn-tambah').addClass('d-none');
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });
    });
</script>

@endsection