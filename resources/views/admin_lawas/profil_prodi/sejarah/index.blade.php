@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Sejarah</h4>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('sejarah.create')}}"class="btn btn-primary" id="btn-tambah">Tambah Sejarah</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Isi Sejarah</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="table-sejarah">
                                <!-- data sejarah -->
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
            url: '/api/admin/sejarah',
            method: 'GET',
            success: function(data) {
                var tableBody = $('#table-sejarah');
                
                // Buat baris tabel baru
                var row = $('<tr></tr>');

                // Tambahkan data kolom
                row.append('<td></td>');

                // Cek panjang isi_sejarah dan tambahkan tombol "Selengkapnya" jika perlu
                var isiSejarah = data.sejarah.isi_sejarah;
                var shortenedSejarah = isiSejarah;
                var showMore = '';

                if (isiSejarah.length > 70) {
                    shortenedSejarah = isiSejarah.substring(0, 70) + '...';
                    showMore = '<a href="#" class="show-more">Selengkapnya</a>';
                }

                row.append('<td><pre style="white-space: pre-wrap; background:000; font-family: sans-serif; line-height: 1.5;">' + shortenedSejarah + ' ' + showMore + '</pre></td>');

                var imagePath = '/images/sejarah/' + data.sejarah.gambar;        
                row.append('<td><img src="' + imagePath + '" alt="' + data.sejarah.gambar + '" style="width: 70px; height: auto; border-radius: 0;"></td>');
                row.append('<td><a href="/admin/sejarah/edit" class="mr-1 btn btn-primary">Edit</a></td>');

                // Tambahkan baris ke dalam tabel
                tableBody.append(row);

                // Tampilkan tombol "Tambah" jika tidak ada data
                $('#btn-tambah').addClass('d-none');

                // Event handler untuk tombol "Selengkapnya"
                $('.show-more').on('click', function(event) {
                    event.preventDefault();
                    $(this).parent().html(isiSejarah);
                });
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });
    });
</script>

@endsection