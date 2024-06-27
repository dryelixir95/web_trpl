@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Daftar Dokumen TA</h4>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('tugas-akhir.create')}}"class="btn btn-primary">Tambah Dokumen TA</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Dokumen TA</th>
                                    <th>File</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="table-dokumen-ta">
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
            url: '/api/admin/tugas-akhir',
            method: 'GET',
            success: function(data) {
                if (Array.isArray(data.ta)) {
                    var tableBody = $('#table-dokumen-ta');

                    var index = 1;
                    // Iterasi setiap user dalam data
                    data.ta.forEach(function(ta) {
                        // Buat baris tabel baru
                        var row = $('<tr></tr>');

                        // Tambahkan data kolom
                        row.append('<td>' + index  + '</td>');
                        row.append('<td>' + ta.nama_file_ta + '</td>');
                        
                        var fileUrl = ta.file_ta; // URL file

                        // row.append('<td><embed src="' +  '/files/ta/' + fileUrl  + '" type="application/pdf" width="70%" height="400px"></td>');
                        row.append('<td><a href="' + '/files/ta/' + fileUrl + '" target="_blank">Lihat File</a></td>');

                        row.append('<td>' + ta.keterangan + '</td>');

                        row.append('<td><button data-id="' + ta.ta_id + '" class="btn btn-danger delete-button">Delete</button></td>');
                        // Tambahkan baris ke dalam tabel
                        tableBody.append(row);

                        index++;
                    });

                    $('.delete-button').on('click', function() {
                    var ta_id = $(this).data('id');
                    deleteTA(ta_id);
                });
                }
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });

        function deleteTA(ta_id) {
            if (confirm('Apa Anda yakin ingin menghapus Dokumen MKI ini?')) {
                $.ajax({
                    url: '/api/admin/tugas-akhir/' + ta_id,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            alert('Dokumen TA deleted successfully');
                            // Remove the Dokumen TA row from the table
                            $('button[data-id="' + ta_id + '"]').closest('tr').remove();
                        } else {
                            alert('Failed to delete Dokumen TA');
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