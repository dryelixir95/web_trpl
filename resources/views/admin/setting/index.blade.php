@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Setting</h4>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Value</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Logo Public</td>
                                    <td id="dataLogoPublic">null</td>
                                    <td><a class="mr-1 btn btn-primary edit-button" data-name="dataLogoPublic">Edit</a></td>
                                </tr>
                                <tr>
                                    <td>Icon Public</td>
                                    <td id="dataIconPublic">null</td>
                                    <td><a class="mr-1 btn btn-primary edit-button" data-name="dataIconPublic">Edit</a></td>
                                </tr>
                                <tr>
                                    <td>Title Web Public</td>
                                    <td id="dataTittleWebPublic">null</td>
                                    <td><a class="mr-1 btn btn-primary edit-button" data-name="dataTittleWebPublic">Edit</a></td>
                                </tr>
                                <tr>
                                    <td>Logo Admin</td>
                                    <td id="dataLogoAdmin">null</td>
                                    <td><a class="mr-1 btn btn-primary edit-button" data-name="dataLogoAdmin">Edit</a></td>
                                </tr>
                                <tr>
                                    <td>Icon Admin</td>
                                    <td id="dataIconAdmin">null</td>
                                    <td><a class="mr-1 btn btn-primary edit-button" data-name="dataIconAdmin">Edit</a></td>
                                </tr>
                                <tr>
                                    <td>Title Web Admin</td>
                                    <td id="dataTittleWebAdmin">null</td>
                                    <td><a class="mr-1 btn btn-primary edit-button" data-name="dataTittleWebAdmin">Edit</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="updateForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Value</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="settingName" id="settingLabel">Name</label>
                        <input type="text" class="form-control" id="settingName" name="name" readonly>
                    </div>
                    <div class="form-group">
                        <label for="settingValue" id="settingLabel">Value</label>
                        <input type="text" class="form-control" id="settingValue" name="value">
                        <input type="file" class="form-control-file" id="settingFile" name="value" style="display:none;">
                    </div>
                    <button type="button" class="btn btn-secondary" id="openMediaModal">Upload from Media</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closeModal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="mediaModal" tabindex="-1" role="dialog" aria-labelledby="mediaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediaModalLabel">Select from Media Library</h5>
            </div>
            <div class="modal-body">
                <div class="row" id="mediaLibrary">
                    <!-- Dynamic content will be loaded here -->
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="closeModalTwo">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        // Fetch settings and populate table
        $.ajax({
            url: '/api/admin/setting',
            method: 'GET',
            success: function(data) {
                if (Array.isArray(data.setting)) {

                    var dataLogoPublic = $('#dataLogoPublic');
                    var dataIconPublic = $('#dataIconPublic');
                    var dataTittleWebPublic = $('#dataTittleWebPublic');
                    var dataLogoAdmin = $('#dataLogoAdmin');
                    var dataIconAdmin = $('#dataIconAdmin');
                    var dataTittleWebAdmin = $('#dataTittleWebAdmin');

                    data.setting.forEach(function(setting) {
                        if(setting.name == dataLogoPublic.attr('id')){
                            dataLogoPublic.html(`<img src="/media/${setting.value}" alt="${setting.name}" style="max-width: 100px;">`);
                        } else if(setting.name == dataIconPublic.attr('id')){
                            dataIconPublic.html(`<img src="/media/${setting.value}" alt="${setting.name}" style="max-width: 100px;">`);
                        } else if(setting.name == dataTittleWebPublic.attr('id')){
                            dataTittleWebPublic.text(setting.value);
                        } else if(setting.name == dataLogoAdmin.attr('id')){
                            dataLogoAdmin.html(`<img src="/media/${setting.value}" alt="${setting.name}" style="max-width: 100px;">`);
                        }else if(setting.name == dataIconAdmin.attr('id')){
                            dataIconAdmin.html(`<img src="/media/${setting.value}" alt="${setting.name}" style="max-width: 100px;">`);
                        }else if(setting.name == dataTittleWebAdmin.attr('id')){
                            dataTittleWebAdmin.text(setting.value);
                        }
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });

        function loadMedia() {
            console.log('tes')
            $.ajax({
                url: '/api/admin/media',
                method: 'GET',
                success: function (data) {
                    var mediaLibrary = $('#mediaLibrary');
                    mediaLibrary.empty();
                    
                    data.media.forEach(function (media, index) {
                        var filePreview = '';
                        if (media.media.match(/\.(jpeg|jpg|gif|png|svg)$/) != null) {
                            filePreview = '<img src="/media/' + media.media + '" class="card-img-top" alt="File" style="height: 150px; object-fit: cover;">';
                        } else if (media.media.match(/\.(pdf)$/) != null) {
                            filePreview = '<embed src="/media/' + media.media + '" type="application/pdf" class="card-img-top" style="height: 150px;">';
                        } else {
                            filePreview = '<div class="card-img-top" style="height: 150px; background: #f0f0f0; display: flex; align-items: center; justify-content: center;">Unknown File</div>';
                        }

                        var card = `
                            <div class="col-md-3 col-sm-6 mb-2">
                                <div class="card">
                                    ${filePreview}
                                    <div class="card-body text-center">
                                        <h6 class="card-title">${media.media}</h6>
                                        <button type="button" class="btn btn-sm btn-primary select-media-file mb-1" data-nama-file="${media.media}"  data-file-url="/media/${media.media}">Select</button>
                                        <button type="button" class="btn btn-sm btn-secondary preview-media-file" data-nama-file="${media.media}"  data-file-url="/media/${media.media}">Preview</button>
                                    </div>
                                </div>
                            </div>
                        `;
                        mediaLibrary.append(card);
                    });

                    data.mediaFiles.forEach(function (file, index) {
                        var filePreview = '';
                        if (file.url.match(/\.(jpeg|jpg|gif|png|svg)$/) != null) {
                            filePreview = '<img src="' + file.url + '" class="card-img-top" alt="File" style="height: 150px; object-fit: cover;">';
                        } else if (file.url.match(/\.(pdf)$/) != null) {
                            filePreview = '<embed src="' + file.url + '" type="application/pdf" class="card-img-top" style="height: 150px;">';
                        } else {
                            filePreview = '<div class="card-img-top" style="height: 150px; background: #f0f0f0; display: flex; align-items: center; justify-content: center;">Unknown File</div>';
                        }

                        var card = `
                            <div class="col-md-3 col-sm-6 mb-2">
                                <div class="card">
                                    ${filePreview}
                                    <div class="card-body text-center">
                                        <h6 class="card-title">${file.name}</h6>
                                        <button type="button" class="btn btn-sm btn-primary select-media-file mb-1" data-nama-file="${file.name}" data-file-url="/media/ckeditor/${file.name}">Select</button>
                                        <button type="button" class="btn btn-sm btn-secondary preview-media-file" data-nama-file="${file.name}"  data-file-url="/media/ckeditor/${file.name}">Preview</button>
                                    </div>
                                </div>
                            </div>
                        `;
                        mediaLibrary.append(card);
                    });
                },
                error: function (xhr, status, error) {
                    console.error('There has been a problem with your AJAX operation:', error);
                }
            });
        }

        $('#mediaLibrary').on('click', '.preview-media-file', function () {
            var fileUrl = $(this).data('file-url');
            window.open(fileUrl, '_blank');
        });

        $('#mediaLibrary').on('click', '.select-media-file', function () {
            var fileUrl = $(this).data('nama-file');
            $('#settingValue').val(fileUrl);
            $('#mediaModal').modal('hide');
        });

        // Show modal and populate fields
        $('.edit-button').on('click', function() {
            var name = $(this).data('name');
            var value = $('#' + name).text();
            $('#settingName').val(name);
            if (name.includes('Tittle')) {
                $('#settingValue').val(value).show();
                $('#settingFile').hide();
            } else {
                $('#settingValue').hide();
                $('#settingFile').show();
            }
            $('#editModal').modal('show');
        });

        $('#closeModal').on('click', function(){
            $('#editModal').modal('hide');
        });

        $('#openMediaModal').click(function() {
            $('#mediaModal').modal('show');
            loadMedia();
        });

        $('#closeModalTwo').click(function() {
            $('#mediaModal').modal('hide');
        });


        // Handle form submit
        $('#updateForm').on('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: '/api/admin/setting',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#editModal').modal('hide');
                    location.reload(); // Refresh page to show updated settings
                },
                error: function(xhr, status, error) {
                    console.error('There has been a problem with your AJAX operation:', error);
                }
            });
        });
    });
</script>

@endsection
