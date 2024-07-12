@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Daftar Dokumen MKI</h4>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('magang-kerja-industri.create')}}"class="btn btn-primary">Tambah Dokumen MKI</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Dokumen MKI</th>
                                    <th>File</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="table-dokumen-mki">
                                <!-- data dokumen mutu -->
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
            url: '/api/admin/magang-kerja-industri',
            method: 'GET',
            success: function(data) {
                if (Array.isArray(data.mki)) {
                    var tableBody = $('#table-dokumen-mki');

                    var index = 1;
                    // Iterasi setiap user dalam data
                    data.mki.forEach(function(mki) {
                        // Buat baris tabel baru
                        var row = $('<tr></tr>');

                        // Tambahkan data kolom
                        row.append('<td>' + index  + '</td>');
                        row.append('<td>' + mki.nama_file_mki + '</td>');
                        
                        var fileUrl = mki.file_mki; // URL file

                        // row.append('<td><embed src="' +  '/files/mki/' + fileUrl  + '" type="application/pdf" width="70%" height="400px"></td>');
                        row.append('<td><a href="' + '/files/mki/' + fileUrl + '" target="_blank">Lihat File</a></td>');

                        row.append('<td>' + mki.keterangan + '</td>');

                        row.append('<td><button data-id="' + mki.mki_id + '" class="btn btn-danger delete-button">Delete</button></td>');
                        // Tambahkan baris ke dalam tabel
                        tableBody.append(row);

                        index++;
                    });

                    $('.delete-button').on('click', function() {
                    var mki_id = $(this).data('id');
                    deleteMKI(mki_id);
                });
                }
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });

        function deleteMKI(mki_id) {
            if (confirm('Apa Anda yakin ingin menghapus Dokumen MKI ini?')) {
                $.ajax({
                    url: '/api/admin/magang-kerja-industri/' + mki_id,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            alert('Dokumen MKI deleted successfully');
                            // Remove the Dokumen MKI row from the table
                            $('button[data-id="' + mki_id + '"]').closest('tr').remove();
                        } else {
                            alert('Failed to delete Dokumen MKI');
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