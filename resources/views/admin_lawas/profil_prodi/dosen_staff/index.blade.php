@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Daftar Dosen & Staff</h4>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('dosen-staff.create')}}"class="btn btn-primary">Tambah Data</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="table-dosen-staff">
                                <!-- data dosen staff -->
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
            url: '/api/admin/dosen-staff',
            method: 'GET',
            success: function(data) {
                if (Array.isArray(data.dosenStaff)) {
                    var tableBody = $('#table-dosen-staff');

                    var index = 1;
                    // Iterasi setiap user dalam data
                    data.dosenStaff.forEach(function(dosenStaff) {
                        // Buat baris tabel baru
                        var row = $('<tr></tr>');

                        // Tambahkan data kolom
                        row.append('<td>' + index  + '</td>');
                        row.append('<td>' + dosenStaff.nama + '</td>');
                        row.append('<td>' + dosenStaff.jabatan + '</td>');

                        var imagePath = '/images/dosenStaff/' + dosenStaff.foto;
                        row.append('<td><img src="' + imagePath + '" alt="' + dosenStaff.gambar + '" style="width: 70px; height: auto; border-radius: 0;"></td>');

                        row.append('<td><a href="'+ '/admin/dosen-staff/edit/' + dosenStaff.dosen_id + '" class="mr-1 btn btn-primary">Edit</a><button data-id="' + dosenStaff.dosen_id + '" class="btn btn-danger delete-button">Delete</button></td>');
                        // Tambahkan baris ke dalam tabel
                        tableBody.append(row);

                        index++;
                    });

                    $('.delete-button').on('click', function() {
                    var dosenStaff_id = $(this).data('id');
                    deleteDosenStaff(dosenStaff_id);
                });
                }
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });

        function deleteDosenStaff(dosenStaff_id) {
        if (confirm('Apa Anda yakin ingin menghapus Data ini?')) {
            $.ajax({
                url: '/api/admin/dosen-staff/' + dosenStaff_id,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        alert('Data deleted successfully');
                        // Remove the Data row from the table
                        $('button[data-id="' + dosenStaff_id + '"]').closest('tr').remove();
                    } else {
                        alert('Failed to delete Data');
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