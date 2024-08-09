@extends('admin.layouts.app')
@section('content')
<style>
    .selected-tags-container {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        min-height: 46px;
        border: 1px solid #ced4da;
        border-radius: 5px;
        padding: 5px;
    }
    .selected-tag-tag  {
        display: inline-block;
        background-color: #007bff;
        color: white;
        padding: 10px 10px;
        border-radius: 5px;
        margin-right: 5px;
        margin-bottom: 15px;
        margin-top: -9px;
    }

    .selected-tag-tag .remove-tag {
        margin-left: 10px;
        cursor: pointer;
        font-weight: bold;
    }
</style>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Post Baru</h4>
                    <form id="updateForm" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" class="form-control" id="judul" name="judul" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-4">
                                <label for="kategori-post" class="form-label">Kategori</label>
                                <select class="custom-select" style="height: 46px;" id="kategori-post" name="kategori-post" disabled>

                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi/isi</label>
                                <textarea class="form-control" id="editor" name="keterangan" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-4">
                            <label for="tag" class="form-label">Tag</label>
                            <div class="input-group">
                                    <select class="custom-select" style="height: 46px;" id="tag" name="tag">
                                        <option value="">Pilih Tag</option>
                                        <!-- option -->
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" id="tambah-tag" type="button">Tambah</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="selected-tag" class="col-sm-2 col-form-label">Tag yang dipilih:</label>
                                <div class="col-sm-10">
                                    <div id="selected-tags-container" class="form-control"></div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12 mb-3">
                                <button type="submit" class="btn btn-primary" id="submitButton">Perbarui</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        var PostId = window.location.pathname.split('/').pop();

        $.ajax({
            url: '/api/admin/kategori-post',
            method: 'GET',
            success: function(data) {
                if (Array.isArray(data.kategori)) {
                    window.dataKategori = data.kategori;
                    var selectMenu = $('#kategori-post');

                    // Iterasi setiap user dalam data
                    data.kategori.forEach(function(kategori) {
                        if(kategori.type_halaman == 'multi-artikel'){
                            // Buat baris tabel baru
                            var option = $('<option></option>').val(kategori.id).text(kategori.nama);
                            
                            // Tambahkan baris ke dalam tabel
                            selectMenu.append(option);
                        }
                    });
                    getPostData(PostId);
                }
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });

        $.ajax({
            url: '/api/admin/tag',
            method: 'GET',
            success: function(data) {
                if (Array.isArray(data.tag)) {
                    var selectMenu = $('#tag');

                    // Iterasi setiap user dalam data
                    data.tag.forEach(function(tag) {
                        // Buat baris tabel baru
                        var option = $('<option></option>').val(tag.tag).text(tag.tag);
                        
                        // Tambahkan baris ke dalam tabel
                        selectMenu.append(option);
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });
        
        function getPostData(PostId){
            $.ajax({
                url: '/api/admin/post/edit/'+ PostId,
                method: 'GET',
                success: function(data) {
                    if (data.post) {
                        window.editor.setData(data.post.deskripsi); // Muat konten artikel jika ada
                        
                        $('#judul').val(data.post.judul);
                        $('#tanggal').val(data.post.tanggal);
                        var selectKategori = $('#kategori-post');

                        selectKategori.find('option').each(function() {
                        if ($(this).val() == data.post.kategori) {
                                $(this).prop('selected', true);
                            }
                        });

                        var tags = data.post.tag ? JSON.parse(data.post.tag) : [];
                        populateSelectedTags(tags);        
                    }
                    window.editor = editor;
                    editor.editing.view.document.on('clipboardInput', (evt, data) => {
                        console.log('Paste event triggered', data);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('There has been a problem with your AJAX operation:', error);
                }
            });
        }
        

        function populateSelectedTags(tags) {
            var selectedTagsContainer = $('#selected-tags-container');
            selectedTagsContainer.empty(); // Kosongkan kontainer sebelumnya

            if (tags && tags.length > 0) {
                tags.forEach(function(tag) {
                    var categoryTag = $('<span class="selected-tag-tag" data-tag="' + tag + '">' + tag + '<span class="remove-tag">&times;</span></span>');
                    selectedTagsContainer.append(categoryTag);

                    // Tambahkan event listener untuk menghapus tag
                    categoryTag.find('.remove-tag').on('click', function() {
                        $(this).parent().remove();
                    });
                });
            }
        }

        $('#tambah-tag').on('click', function(event) {
            event.preventDefault(); // Mencegah tindakan default tombol

            // Ambil nilai tag yang dipilih
            var selectedTag = $('#tag').val();
            var selectedTagName = $('#tag option:selected').text();

            if (!selectedTag) return; 

            // Cek apakah tag sudah ada
            var tagExists = false;
            $('#selected-tags-container .selected-tag-tag').each(function() {
                if ($(this).data('tag') == selectedTag) {
                    tagExists = true;
                    return false; // Break the loop
                }
            });

            if (!tagExists) {
                // Tambahkan kategori yang dipilih sebagai tag
                var categoryTag = $('<span class="selected-tag-tag" data-tag="' + selectedTag + '">' + selectedTagName + '<span class="remove-tag">&times;</span></span>');
                $('#selected-tags-container').append(categoryTag);

                // Tambahkan event listener untuk menghapus tag
                categoryTag.find('.remove-tag').on('click', function() {
                    $(this).parent().remove();
                });
            }
            $('#tag').val('');
        });

        $('#submitButton').on('click', function(event) {
            event.preventDefault();

            var formData = new FormData();
            formData.append('judul', $('#judul').val());
            formData.append('tanggal', $('#tanggal').val());
            formData.append('kategori', $('#kategori-post').val());

            const editorData = window.editor.getData();
            formData.append('deskripsi', editorData); // Ambil data CKEditor

            // Menyertakan tag yang dipilih
            $('#selected-tags-container .selected-tag-tag').each(function() {
                formData.append('tags[]', $(this).data('tag'));
            });

            $.ajax({
                url: '/api/admin/post/'+ PostId,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false, 
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-HTTP-Method-Override': 'PUT'
                },
                success: function(data) {
                    console.log(data);
                    window.location.href = data.url;
                },
                error: function(xhr, status, error) {
                    console.error('There has been a problem with your AJAX operation:', error);
                },
            });

        });
    });
</script>
@endsection
