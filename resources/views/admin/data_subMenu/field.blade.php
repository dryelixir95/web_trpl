@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"></h4>
                    <form id="UpdateField" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="name_field" class="form-label">Nama Field</label>
                                <input type="text" class="form-control" id="name_field" name="name_field">
                            </div>
                            <div class="col-4">
                                <label for="type_field" class="form-label">Type Field</label>
                                <select class="form-control" id="type_field" name="type_field">
                                    <option value="">Pilih Type</option>
                                    <option value="textarea">Text Panjang</option>
                                    <option value="text">Text Pendek</option>
                                    <option value="date">Tanggal</option>
                                    <option value="file">File/Gambar</option>
                                </select>
                            </div>
                            <div class="col-2 text-center">
                                <div class="form-check">
                                    <label class="form-check-label" for="nullable_field">Boleh Null?</label>
                                    <input class="form-check-input ml-2" type="checkbox" id="nullable_field" name="nullable_field">
                                </div>
                            </div>
                            <div class="col-2 mt-3 text-end">
                            <button id="tambah-field" class="btn btn-success">Tambah Field</button>
                            </div>

                        </div>

                        <div class="table-responsive">
                            <table class="table">
                                <thead id="table-head">
                                    <tr>
                                        <th>Nama Field</th>
                                        <th>Type Field</th>
                                        <th>Null</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                    <!-- data body -->
                                </tbody>
                            </table>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                    </form>
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
        var formattedTitle = subMenu.split('-').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(
            ' ');

        $('.card-title').text('Setting ' + formattedTitle);

        $.ajax({
            url: '/api/admin/' + kategori + '/' + subMenu,
            method: 'GET',
            success: function (data) {
                if (Array.isArray(data.fields)) {
                    var tableHead = $('#table-body');

                    // Iterasi setiap field dalam data
                    data.fields.forEach(function (field) {
                        // Buat baris tabel baru
                        var row = $('<tr></tr>');
                        row.append('<td>' + field.nama_field + '</td>');
                        row.append('<td>' + field.type_field + '</td>');

                        var checked = field.null == 'null' ? 'checked' : '';
                        row.append('<td><input type="checkbox" class="form-check-input ml-2" ' + checked + '></td>');
                        
                        row.append(
                            '<td><button type="button" class="btn btn-danger remove-field">Hapus</button></td>'
                            );

                        // Tambahkan baris ke dalam tabel
                        tableHead.append(row);
                    });
                    $('#name_field').val('');
                }
            },
            error: function (xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });

        $('#tambah-field').click(function (event) {
            event.preventDefault();

            var nameField = $('#name_field').val();
            var typeField = $('#type_field').val();
            var nullableField = $('#nullable_field').is(':checked') ? 'checked' : '';

            if (nameField && typeField) {
                var row = $('<tr></tr>');
                row.append('<td>' + nameField + '</td>');
                row.append('<td>' + typeField + '</td>');
                row.append('<td><input type="checkbox" class="form-check-input ml-2" ' + nullableField + '></td>');
                row.append(
                    '<td><button type="button" class="btn btn-danger remove-field">Hapus</button></td>'
                    );
                $('#table-body').append(row);
                $('#name_field').val('');
                $('#type_field').val(''); // Reset select input to default
                $('#nullable_field').prop('checked', false); // Reset checkbox
            }
        });

        // Remove field from table
        $(document).on('click', '.remove-field', function () {
            $(this).closest('tr').remove();
        });

        $('#UpdateField').submit(function (event) {
            event.preventDefault();

            var fields = [];
            $('#table-body tr').each(function () {
                var fieldName = $(this).find('td').eq(0).text();
                var fieldType = $(this).find('td').eq(1).text();
                var fieldNullable = $(this).find('td').eq(2).find('input').is(':checked') ? true : false;

                fields.push({
                    name: fieldName,
                    type: fieldType,
                    nullable: fieldNullable
                });
            });

            var formData = {
                fields: fields
            };

            $.ajax({
                url: '/api/admin/' + kategori + '/' + subMenu,
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(formData),
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (data) {
                    console.log(data);
                    window.location.href = data.url;
                },
                error: function (xhr, status, error) {
                    console.error('There has been a problem with your AJAX operation:',
                        error);
                }
            });
        });
    });

</script>
@endsection
