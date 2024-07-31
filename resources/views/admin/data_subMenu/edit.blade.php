@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"></h4>
                        <form id="UpdateForm" enctype="multipart/form-data" method="POST">
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
        var dataId = window.location.pathname.split('/').pop();

        var formattedTitle = subMenu.split('-').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');

        $('.card-title').text('Edit Data ' + formattedTitle);
        $.ajax({
            url: '/api/admin/' + kategori + '/' + subMenu + '/data/' + dataId,
            method: 'GET',
            success: function(data) {
                if (Array.isArray(data.fields)) {
                    var form_data = $('#UpdateForm');

                    // Iterasi setiap field dalam data
                    data.fields.forEach(function(field) {
                        // Buat baris tabel baru
                        var row = $('<div class="row"></div>');
                        var div = $('<div class="col-12 mb-3"></div>');
                        var inputElement;
                        var fieldValue = '';

                        data.dataDetailSubMenu.forEach(function(detail){
                            if(detail.tag == field.tag){
                                fieldValue = detail.value;
                            }
                        });

                        if(field.type_field == 'text'){
                            inputElement = '<input type="text" class="form-control" id="'+field.tag+'" name="'+field.tag+'" value="'+fieldValue+'" data-type-field="text">';
                        } else if(field.type_field == 'textarea'){
                            inputElement = '<textarea class="form-control" id="' + field.tag + '" name="' + field.tag + '" rows="10" data-type-field="textarea">' + fieldValue + '</textarea>';
                        } else if(field.type_field == 'date'){
                            inputElement = '<input type="date" class="form-control" id="'+field.tag+'" name="'+field.tag+'" value="'+fieldValue+'" data-type-field="date">';
                        } else {
                            inputElement = '<input type="file" class="form-control-file" id="'+field.tag+'" name="'+field.tag+'" value="'+fieldValue+'" data-type-field="file" accept=".jpeg,.png,.jpg,.gif,.svg,.pdf,.doc,.docx,.xls,.xlsx">';
                            
                            // Tambahkan tampilan file jika sudah ada
                            if (fieldValue) {
                                var imageExtensions = ['jpeg', 'jpg', 'png', 'gif', 'svg'];
                                var isImage = imageExtensions.some(ext => fieldValue.endsWith('.' + ext));
                                var isPdf = fieldValue.endsWith('.pdf');

                                if (isImage) {
                                    inputElement += '<br><div class="text-center"><img src="/files/' + fieldValue + '" alt="Image" class="img-fluid preview" width="250px" height="100%"></div>';
                                } else if (isPdf) {
                                    inputElement += '<br><div class="text-center"><embed src="/files/' + fieldValue + '" type="application/pdf" width="500px" height="750px" class="preview"></div>';
                                } else {
                                    inputElement += '<br><a href="/files/' + fieldValue + '" target="_blank" class="preview-link">View Existing File</a>';
                                }
                            }
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

                    // Tambahkan event listener untuk menampilkan pratinjau file baru
                    form_data.on('change', 'input[type="file"]', function() {
                        var fileInput = $(this);
                        var file = this.files[0];
                        var previewContainer = fileInput.closest('div').find('.preview, .preview-link');
                        
                        if (file) {
                            var reader = new FileReader();
                            
                            reader.onload = function(e) {
                                if (file.type.startsWith('image/')) {
                                    if (previewContainer.is('img')) {
                                        previewContainer.attr('src', e.target.result);
                                    } else {
                                        previewContainer.replaceWith('<div class="text-center"><img src="' + e.target.result + '" alt="Image" class="img-fluid preview" width="250px" height="100%"></div>');
                                    }
                                } else if (file.type === 'application/pdf') {
                                    if (previewContainer.is('embed')) {
                                        previewContainer.attr('src', e.target.result);
                                    } else {
                                        previewContainer.replaceWith('<div class="text-center"><embed src="' + e.target.result + '" type="application/pdf" width="500px" height="750px" class="preview"></div>');
                                    }
                                } else {
                                    if (previewContainer.is('a')) {
                                        previewContainer.attr('href', e.target.result).text('View New File');
                                    } else {
                                        previewContainer.replaceWith('<a href="' + e.target.result + '" target="_blank" class="preview-link">View New File</a>');
                                    }
                                }
                            };
                            
                            reader.readAsDataURL(file);
                        }
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });

        $('#UpdateForm').submit(function(event) {
            event.preventDefault(); 

            var formData = new FormData(this);

            $('#UpdateForm').find('input, textarea').each(function() {
                var fieldType = $(this).data('type-field');
                if (fieldType) {
                    formData.append($(this).attr('name') + '-type', fieldType);
                }
            });

            $.ajax({
                url: '/api/admin/' + kategori + '/' + subMenu +'/data/' + dataId,
                method: 'POST',
                contentType: 'application/json',
                data: formData,
                processData: false,
                contentType: false, 
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-HTTP-Method-Override': 'PUT',
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
