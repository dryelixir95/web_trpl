@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Daftar Surat Edar Mahasiswa</h4>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('surat-edar.create')}}"class="btn btn-primary">Tambah Surat Edar</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Surat Edar</th>
                                    <th>File</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="table-surat-edar">
                                <!-- data surat edar -->
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
            url: '/api/admin/surat-edar',
            method: 'GET',
            success: function(data) {
                if (Array.isArray(data.suratEdar)) {
                    var tableBody = $('#table-surat-edar');

                    var index = 1;
                    // Iterasi setiap user dalam data
                    data.suratEdar.forEach(function(suratEdar) {
                        // Buat baris tabel baru
                        var row = $('<tr></tr>');

                        // Tambahkan data kolom
                        row.append('<td>' + index  + '</td>');
                        row.append('<td>' + suratEdar.nama_surat_edar + '</td>');
                        
                        var fileUrl = suratEdar.file_surat_edar; // URL file

                        // row.append('<td><embed src="' +  '/files/surat-edar/' + fileUrl  + '" type="application/pdf" width="70%" height="400px"></td>');
                        row.append('<td><a href="' + '/files/surat-edar/' + fileUrl + '" target="_blank">Lihat File</a></td>');

                        row.append('<td>' + suratEdar.keterangan + '</td>');

                        row.append('<td><button data-id="' + suratEdar.surat_edar_id + '" class="btn btn-danger delete-button">Delete</button></td>');
                        // Tambahkan baris ke dalam tabel
                        tableBody.append(row);

                        index++;
                    });

                    $('.delete-button').on('click', function() {
                    var surat_edar_id = $(this).data('id');
                    deleteSuratEdar(surat_edar_id);
                });
                }
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });

        function deleteSuratEdar(surat_edar_id) {
            if (confirm('Apa Anda yakin ingin menghapus Surat Edar ini?')) {
                $.ajax({
                    url: '/api/admin/surat-edar/' + surat_edar_id,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            alert('Surat Edar deleted successfully');
                            // Remove the Dokumen TA row from the table
                            $('button[data-id="' + surat_edar_id + '"]').closest('tr').remove();
                        } else {
                            alert('Failed to delete Surat Edar');
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