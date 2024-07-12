@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Daftar Dokumen Mutu</h4>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('dokumen-mutu.create')}}"class="btn btn-primary">Tambah Dokumen Mutu</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Dokumen Mutu</th>
                                    <th>File</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="table-dokumen-mutu">
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
            url: '/api/admin/dokumen-mutu',
            method: 'GET',
            success: function(data) {
                if (Array.isArray(data.dokumenMutu)) {
                    var tableBody = $('#table-dokumen-mutu');

                    var index = 1;
                    // Iterasi setiap user dalam data
                    data.dokumenMutu.forEach(function(dokumenMutu) {
                        // Buat baris tabel baru
                        var row = $('<tr></tr>');

                        // Tambahkan data kolom
                        row.append('<td>' + index  + '</td>');
                        row.append('<td>' + dokumenMutu.nama_Dmutu + '</td>');
                        
                        var fileUrl = dokumenMutu.file_Dmutu; // URL file

                        // row.append('<td><embed src="' +  '/files/dmutu/' + fileUrl  + '" type="application/pdf" width="70%" height="400px"></td>');
                        row.append('<td><a href="' + '/files/dmutu/' + fileUrl + '" target="_blank">Lihat File</a></td>');

                        row.append('<td>' + dokumenMutu.keterangan + '</td>');

                        row.append('<td><button data-id="' + dokumenMutu.Dmutu_id + '" class="btn btn-danger delete-button">Delete</button></td>');
                        // Tambahkan baris ke dalam tabel
                        tableBody.append(row);

                        index++;
                    });

                    $('.delete-button').on('click', function() {
                    var Dmutu_id = $(this).data('id');
                    deleteDokumenMutu(Dmutu_id);
                });
                }
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });

        function deleteDokumenMutu(Dmutu_id) {
            if (confirm('Apa Anda yakin ingin menghapus Dokumen Mutu ini?')) {
                $.ajax({
                    url: '/api/admin/dokumen-mutu/' + Dmutu_id,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            alert('Dokumen Mutu deleted successfully');
                            // Remove the Dokumen Mutu row from the table
                            $('button[data-id="' + Dmutu_id + '"]').closest('tr').remove();
                        } else {
                            alert('Failed to delete Dokumen Mutu');
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