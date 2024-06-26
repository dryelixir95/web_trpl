@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Daftar Prestasi</h4>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('prestasi.create')}}"class="btn btn-primary">Tambah Prestasi</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Prestasi</th>
                                    <th>Keterangan</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="table-prestasi">
                                <!-- data prestasi -->
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
            url: '/api/admin/prestasi',
            method: 'GET',
            success: function(data) {
                if (Array.isArray(data.prestasi)) {
                    var tableBody = $('#table-prestasi');

                    var index = 1;
                    // Iterasi setiap prestasi dalam data
                    data.prestasi.forEach(function(prestasi) {
                        // Buat baris tabel baru
                        var row = $('<tr></tr>');

                        // Tambahkan data kolom
                        row.append('<td>' + index  + '</td>');
                        row.append('<td>' + prestasi.nama_prestasi + '</td>');

                        // Cek panjang isi_sejarah dan tambahkan tombol "Selengkapnya" jika perlu
                        var isiKeterangan = prestasi.keterangan;
                        var shortenedSejarah = isiKeterangan;
                        var showMore = '';

                        if (isiKeterangan.length > 70) {
                            shortenedSejarah = isiKeterangan.substring(0, 70) + '...';
                            showMore = '<a href="#" class="show-more">Selengkapnya</a>';
                        }

                        row.append('<td><pre style="white-space: pre-wrap; background:000; font-family: Nunito; line-height: 1.5; padding: 0px;">' + shortenedSejarah + ' ' + showMore + '</pre></td>');                        
                        
                        var imagePath = '/images/prestasi/' + prestasi.gambar;
                        row.append('<td><img src="' + imagePath + '" alt="' + prestasi.nama_prestasi + '" style="width: 70px; height: auto; border-radius: 0;"></td>');
                        row.append('<td><a href="'+ '/admin/prestasi/edit/' + prestasi.prestasi_id + '" class="mr-1 btn btn-primary">Edit</a><button data-id="' + prestasi.prestasi_id + '" class="btn btn-danger delete-button">Delete</button></td>');
                        // Tambahkan baris ke dalam tabel
                        tableBody.append(row);

                        index++;

                        $('.show-more').on('click', function(event) {
                            event.preventDefault();
                            $(this).parent().html(isiKeterangan);
                        });
                    });

                    $('.delete-button').on('click', function() {
                        var prestasiId = $(this).data('id');
                        deletePrestasi(prestasiId);
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });

        function deletePrestasi(prestasiId) {
        if (confirm('Apa Anda yakin ingin menghapus prestasi ini?')) {
            $.ajax({
                url: '/api/admin/prestasi/' + prestasiId,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        alert('Prestasi deleted successfully');
                        // Remove the Prestasi row from the table
                        $('button[data-id="' + prestasiId + '"]').closest('tr').remove();
                    } else {
                        alert('Failed to delete Prestasi');
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