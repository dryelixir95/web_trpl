@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4 id="card-title" class="card-title">Beranda</h4>
                        </div>
                        @if(Auth::user()->role == 'Admin')
                        <div class="col-6 text-end">
                            <a href="#" id="setting-data-beranda" class="btn btn-success">Atur Data</a>
                            <a href="{{ route('beranda.create')}}" id="add-data-beranda" class="btn btn-primary">Tambah Data</a>
                        </div>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name Data</th>
                                    <th>Child Menu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                <!-- data body -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<style>
    .modal-lg {
        max-width: 50% !important;
        max-height: 90% !important;
        top: -50px;
    }

    .modal-content {
        margin-top: 0vh; /* Atur nilai ini sesuai keinginan Anda */
    }
</style>
<div class="modal fade" id="dataBerandaModal" tabindex="-1" aria-labelledby="dataBerandaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dataBerandaModalLabel">Setting Data Beranda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Kategori</th>
                                <th>Child Menu</th>
                                <th>Tambah Beranda</th>
                            </tr>
                        </thead>
                        <tbody id="allKategori">
                            <!-- Dynamic content will be loaded here -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        var kategori = window.location.pathname.split('/').pop();

        $('#setting-data-beranda').click(function (event) {
            event.preventDefault();
            $('#dataBerandaModal').modal('show');
        });

        $.ajax({
            url: '/api/admin/beranda',
            method: 'GET',
            success: function (data) {
                if (Array.isArray(data.kategori)) {
                    var tableBody = $('#table-body');

                    // Iterasi setiap user dalam data
                    data.kategori.forEach(function (kategori) {

                        var nama_subMenu = kategori.nama.toLowerCase().replace(/\s+/g,
                            '-');
                        // Buat baris tabel baru
                        var row = $('<tr></tr>');

                        // Tambahkan data kolom
                        row.append('<td>' + kategori.nama + '</td>');

                        var menukategori;
                        data.menu.forEach(function(menu) {
                            if(menu.id == kategori.index_menu){
                                menukategori = '<td id="'+kategori.index_menu+'">' +menu.nama_menu + '</td>';
                            } else if( kategori.index_menu == null){
                                menukategori = '<td>Beranda</td>';
                            }
                        });
                        row.append(menukategori);
                        
                        var url;
                        data.menu.forEach(function(menu) {
                            if(kategori.type_halaman == 'multi-artikel'){
                                url='/admin/post';
                            } else{
                                url='/admin/halaman';
                            }
                        });
                        row.append('<td><a href=" '+url+'" class="btn btn-primary mr-1">Detail</a><button data-id="' + kategori.id +'" class="btn btn-danger delete-button">Delete</button></td>');

                        // Tambahkan baris ke dalam tabel
                        tableBody.append(row);
                    });

                    $('.delete-button').on('click', function () {
                        var kategoriId = $(this).data('id');
                        deleteMenu(kategoriId);
                    });
                }
                if (Array.isArray(data.allKategori)) {
                    var allKategori = $('#allKategori');
                    data.allKategori.forEach(function (kategori) {
                        if(kategori.index_menu != null){
                            var row = $('<tr></tr>');
                            row.append('<td>' + kategori.nama + '</td>');
                            data.menu.forEach(function(menu) {
                                if(menu.id == kategori.index_menu){
                                    row.append('<td id="'+kategori.index_menu+'">' +menu.nama_menu + '</td>');
                                }
                            });
                            row.append('<td><input type="checkbox" class="form-check-input ml-5" style="margin-top: -0.3rem;" name="beranda[]" value="' + kategori.id + '" ' + (kategori.beranda ? 'checked' : '') + '></td>');
                            allKategori.append(row);
                        }
                    });
                }

            },
            error: function (xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });

        function deleteMenu(kategoriId) {
            if (confirm('Apa Anda yakin ingin menghapus kategori ini?')) {
                $.ajax({
                    url: '/api/admin/beranda/' + kategoriId,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            alert('Kategori deleted successfully');
                            // Remove the Menu row from the table
                            location.reload();
                        } else {
                            alert('Failed to delete kategori');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('There has been a problem with your AJAX operation:', error);
                    }
                });
            }
        }

        $('#saveChanges').click(function() {
            var selectedSubMenus = [];
            $('input[name="beranda[]"]:checked').each(function() {
                selectedSubMenus.push($(this).val());
            });

            $.ajax({
                url: '/api/admin/beranda',
                method: 'POST',
                data: {
                    beranda: selectedSubMenus
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-HTTP-Method-Override': 'PUT',
                },

                success: function(response) {
                    if (response.status === 'success') {
                        alert('Changes saved successfully');
                        location.reload();
                    } else {
                        alert('Failed to save changes');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('There has been a problem with your AJAX operation:', error);
                }
            });
        });
    });

</script>
@endsection
