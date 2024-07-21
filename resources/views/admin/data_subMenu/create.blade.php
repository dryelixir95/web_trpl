@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"></h4>
                        <form id="StoreForm" enctype="multipart/form-data" method="POST">
                        @csrf
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        var kategori = window.location.pathname.split('/')[2];
        var subMenu = window.location.pathname.split('/')[3];
        var formattedTitle = subMenu.split('-').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');

        $('.card-title').text('Tambah Data ' + formattedTitle);
        $.ajax({
            url: '/api/admin/' + kategori + '/' + subMenu,
            method: 'GET',
            success: function(data) {
                if (Array.isArray(data.fields)) {
                    var form_data = $('#StoreForm');

                    // Iterasi setiap field dalam data
                    data.fields.forEach(function(field) {
                        var row = $('<div class="row"></div>');
                        var div = $('<div class="col-12 mb-3"></div>')
                        var inputElement;
                        
                        if(field.type_field == 'text'){
                            inputElement = '<input type="text" class="form-control" id="'+field.tag+'" name="'+field.tag+'" data-type-field="text">';
                        } else if(field.type_field == 'textarea'){
                            inputElement = '<textarea class="form-control" id="'+field.tag+'" name="'+field.tag+'" rows="10" data-type-field="textarea"></textarea>';
                        } else if(field.type_field == 'date'){
                            inputElement = '<input type="date" class="form-control" id="'+field.tag+'" name="'+field.tag+'" data-type-field="date">';
                        } else{
                            inputElement = '<input type="file" class="form-control-file" id="'+field.tag+'" name="'+field.tag+'" data-type-field="file" accept=".jpeg,.png,.jpg,.gif,.svg,.pdf,.doc,.docx,.xls,.xlsx">';
                        }
                        
                        // Tambahkan atribut 'required' jika field tidak boleh null
                        if (field.null == 'not') {
                            inputElement = $(inputElement).attr('required', 'required')[0].outerHTML;
                        }

                        div.append('<label for="'+field.tag+'" class="form-label">'+field.nama_field+'</label>' + inputElement);
                        row.append(div);

                        // Tambahkan baris ke dalam tabel
                        form_data.append(row);
                    });
                    form_data.append('<button type="submit" class="btn btn-primary">Simpan</button>')
                }
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });

        // Function to handle file input changes
        $(document).on('change', 'input[type="file"]', function() {
            var fileInput = $(this);
            var file = fileInput[0].files[0];
            var reader = new FileReader();
            var fileType = file.type;

            reader.onload = function(e) {
                var result = e.target.result;
                var filePreview = '';

                if (fileType.startsWith('image/')) {
                    filePreview = '<img src="' + result + '" alt="Image Preview" style="width: 500px; height: auto; margin-top: 10px;">';
                } else if (fileType === 'application/pdf') {
                    filePreview = '<embed src="' + result + '" type="application/pdf" style="width: 500px; height: 750px; margin-top: 10px;">';
                }

                fileInput.siblings('.file-preview').remove(); // Remove previous previews
                fileInput.after('<div class="file-preview text-center">' + filePreview + '</div>');
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        });

        $('#StoreForm').submit(function(event) {
            event.preventDefault(); 

            var formData = new FormData(this);

            $('#StoreForm').find('input, textarea').each(function() {
                var fieldType = $(this).data('type-field');
                if (fieldType) {
                    formData.append($(this).attr('name') + '-type', fieldType);
                }
            });

            $.ajax({
                url: '/api/admin/' + kategori + '/' + subMenu +'/data',
                method: 'POST',
                contentType: 'application/json',
                data: formData,
                processData: false,
                contentType: false, 
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(data) {
                    console.log(data);
                    window.location.href = data.url;
                },
                error: function(xhr, status, error) {
                    console.error('There has been a problem with your AJAX operation:', error);
                }
            });
        });
    });
</script>
@endsection
