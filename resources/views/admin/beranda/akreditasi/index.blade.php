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
                        <div class="col-6 text-end d-none">
                            <a href="{{ route('akreditasi.create')}}" class="btn btn-primary" id="btn-tambah">Tambah</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
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
                row.append('<td>' + '1' + '</td>');
                row.append('<td>' + data.akreditasis.tgl_akreditasi + '</td>');
                row.append('<td>' + data.akreditasis.file_akreditasi + '</td>');
                row.append('<td><a href="/admin/akreditasi/edit "class="mr-1 btn btn-primary">Edit</a></td>');
                
                // Tambahkan baris ke dalam tabel
                tableBody.append(row);

                // Tampilkan tombol "Tambah" jika tidak ada data
                $('#btn-tambah').removeClass('d-none');
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });
    });
</script>

@endsection