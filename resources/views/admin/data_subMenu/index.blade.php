@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4 id="card-title" class="card-title"></h4>
                        </div>
                        <div class="col-6 text-end">
                            <a href="#" id="setting-field-submenu" class="btn btn-success">Setting Field Data</a>
                            <a href="#" id="tambah-data-submenu" class="btn btn-primary" hidden>Add Data</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead id="table-head">
                                <!-- table-head -->
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
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        var kategori = window.location.pathname.split('/')[2];
        var subMenu = window.location.pathname.split('/')[3];

        var formattedTitle = subMenu.split('-').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');

        $('.card-title').text('Daftar ' + formattedTitle);

        $('#tambah-data-submenu').click(function (event) {
            event.preventDefault();
            var url = '/admin/' + kategori + '/' + subMenu + '/add';
            // Mengarahkan pengguna ke URL yang sesuai
            window.location.href = url;
        });

        $('#setting-field-submenu').click(function (event) {
            event.preventDefault();
            var url = '/admin/' + kategori + '/' + subMenu + '/field';
            // Mengarahkan pengguna ke URL yang sesuai
            window.location.href = url;
        });

        $.ajax({
            url: '/api/admin/' + kategori + '/' + subMenu + '/data',
            method: 'GET',
            success: function(data) {
                if (Array.isArray(data.fields)) {
                    var tableHead = $('#table-head');
                    var row = $('<tr></tr>');

                    // Iterasi setiap field dalam data
                    data.fields.forEach(function (field) {
                        // Tambahkan data kolom
                        row.append('<th id="' + field.tag + '">' + field.nama_field + '</th>');
                        $('#tambah-data-submenu').removeAttr('hidden');
                        // Tambahkan baris ke dalam tabel
                    });
                    row.append('<th>Action</th>');
                    tableHead.append(row);
                }

                if (Array.isArray(data.dataDetailSubMenu)) {
                    var tableBody = $('#table-body');

                    // Iterate through data to create table rows
                    data.dataDetailSubMenu.forEach(function(detail) {
                        var row = $('<tr></tr>');
                        var detailDataId = detail[0].dataSubmenu_id;

                        // Add data columns
                        data.fields.forEach(function(field) {
                            var value = detail.find(d => d.tag === field.tag)?.value || 'null';
                            var fileExtensions = ['jpeg', 'jpg', 'png', 'gif', 'svg', 'pdf', 'doc', 'docx', 'xls', 'xlsx'];
                            var isFile = fileExtensions.some(ext => value.endsWith('.' + ext));

                            if (isFile) {
                                value = '<a href="/files/' + value + '" target="_blank">View File</a>';
                            } else {
                                if (value.length > 70) {
                                    var shortenedValue = value.substring(0, 70) + '...';
                                    value = '<pre style="white-space: pre-wrap; background:000; font-family: sans-serif; line-height: 1.5;">' + shortenedValue + ' <a href="#" class="show-more" data-full-text="' + value + '">Selengkapnya</a></pre>';
                                } else {
                                    value = '<pre style="white-space: pre-wrap; background:000; font-family: sans-serif; line-height: 1.5;">' + value + '</pre>';
                                }
                            }

                            row.append('<td>' + value + '</td>');
                        });

                        row.append('<td><a href="/admin/' + kategori + '/' + subMenu + '/data/edit/' + detailDataId + '" class="mr-1 btn btn-primary edit-button">Edit</a><button data-id="' + detailDataId + '" class="btn btn-danger delete-button">Delete</button></td>');
                        tableBody.append(row);
                    });

                    // Add delete event listener
                    $('.delete-button').on('click', function() {
                        var dataId = $(this).data('id');
                        deleteData(dataId);
                    });

                    // Add show more event listener
                    $(document).on('click', '.show-more', function(event) {
                        event.preventDefault();
                        var fullText = $(this).data('full-text');
                        $(this).parent().text(fullText);
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });


        function deleteData(dataId) {
            if (confirm('Apa Anda yakin ingin menghapus Data ini?')) {
                $.ajax({
                    url: '/api/admin/' + kategori + '/' + subMenu +'/data/' + dataId,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            alert('Data deleted successfully');
                            // Remove the Data row from the table
                            $('button[data-id="' + dataId + '"]').closest('tr').remove();
                        } else {
                            alert('Failed to delete data');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('There has been a problem with your AJAX operation:', error);
                    }
                });
            }
        }
    });
</script>

@endsection
