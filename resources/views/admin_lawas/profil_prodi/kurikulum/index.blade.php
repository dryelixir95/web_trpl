@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Daftar Kurikulum</h4>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('kurikulum.create')}}"class="btn btn-primary">Tambah Kurikulum</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Semester</th>
                                    <th>File</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="table-kurikulum">
                                <!-- data kurikulum -->
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
            url: '/api/admin/kurikulum',
            method: 'GET',
            success: function(data) {
                if (Array.isArray(data.kurikulums)) {
                    var tableBody = $('#table-kurikulum');

                    var index = 1;
                    // Iterasi setiap user dalam data
                    data.kurikulums.forEach(function(kurikulum) {
                        // Buat baris tabel baru
                        var row = $('<tr></tr>');

                        // Tambahkan data kolom
                        row.append('<td>' + index  + '</td>');
                        row.append('<td>' + kurikulum.semester + '</td>');
                        
                        var fileUrl = kurikulum.file_kurikulum; // URL file

                        // row.append('<td><embed src="' +  '/files/kurikulum/' + fileUrl  + '" type="application/pdf" width="70%" height="400px"></td>');
                        row.append('<td><a href="' + '/files/kurikulum/' + fileUrl + '" target="_blank">Lihat File</a></td>');

                        row.append('<td><button data-id="' + kurikulum.kurikulum_id + '" class="btn btn-danger delete-button">Delete</button></td>');
                        // Tambahkan baris ke dalam tabel
                        tableBody.append(row);

                        index++;
                    });

                    $('.delete-button').on('click', function() {
                    var kurikulum_id = $(this).data('id');
                    deleteKurikulum(kurikulum_id);
                });
                }
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });

        function deleteKurikulum(kurikulum_id) {
            if (confirm('Apa Anda yakin ingin menghapus Kurikulum ini?')) {
                $.ajax({
                    url: '/api/admin/kurikulum/' + kurikulum_id,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            alert('Kurikulum deleted successfully');
                            // Remove the Kurikulum row from the table
                            $('button[data-id="' + kurikulum_id + '"]').closest('tr').remove();
                        } else {
                            alert('Failed to delete Kurikulum');
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