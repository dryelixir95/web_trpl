@extends('admin.layouts.app')
@section('content')
<style>
    .selected-categories-container, .selected-tags-container {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        min-height: 46px;
        border: 1px solid #ced4da;
        border-radius: 5px;
        padding: 5px;
    }
    .selected-category-tag, .selected-tag-tag  {
        display: inline-block;
        background-color: #007bff;
        color: white;
        padding: 10px 10px;
        border-radius: 5px;
        margin-right: 5px;
        margin-bottom: 15px;
        margin-top: -9px;
    }

    .selected-category-tag .remove-tag, .selected-tag-tag .remove-tag {
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
                    <form id="StoreForm" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" class="form-control" id="judul" name="judul" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-4">
                                <label for="kategori" class="form-label">Kategori</label>
                                <div class="input-group">
                                    <select class="custom-select" style="height: 46px;" id="kategori" name="kategori">
                                        <option value="">Pilih Kategori</option>
                                        <!-- option -->
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" id="tambah-kategori" type="button">Tambah</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="selected-category" class="col-sm-2 col-form-label">Kategori yang dipilih:</label>
                                <div class="col-sm-10">
                                    <div id="selected-categories-container" class="form-control"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi/isi</label>
                                <textarea class="form-control" id="editor" name="keterangan" rows="10"></textarea>
                                <small class="form-text" style="color: red;">bisa tidak di isi</small>
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
                                <button type="submit" class="btn btn-primary" id="submitButton">Simpan</button>
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
        $.ajax({
            url: '/api/admin/kategori-post',
            method: 'GET',
            success: function(data) {
                if (Array.isArray(data.kategori)) {
                    var selectMenu = $('#kategori');

                    // Iterasi setiap user dalam data
                    data.kategori.forEach(function(kategori) {
                        // Buat baris tabel baru
                        var option = $('<option></option>').val(kategori.id).text(kategori.slug);
                        
                        // Tambahkan baris ke dalam tabel
                        selectMenu.append(option);
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });

        $('#tambah-kategori').on('click', function(event) {
            event.preventDefault(); // Mencegah tindakan default tombol

            // Ambil nilai kategori yang dipilih
            var selectedCategory = $('#kategori').val();
            var selectedCategoryName = $('#kategori option:selected').text();

            if (!selectedCategory) return; 

            var categoryExists = false;
            $('#selected-categories-container .selected-category-tag').each(function() {
                if ($(this).data('category') == selectedCategory) {
                    categoryExists = true;
                    return false; // Break the loop
                }
            });

            if (!categoryExists) {
                // Tambahkan kategori yang dipilih sebagai tag
                var categoryTag = $('<span class="selected-category-tag" data-category="' + selectedCategory + '">' + selectedCategoryName + '<span class="remove-tag">&times;</span></span>');
                $('#selected-categories-container').append(categoryTag);

                // Tambahkan event listener untuk menghapus tag
                categoryTag.find('.remove-tag').on('click', function() {
                    $(this).parent().remove();
                });
            }
            $('#kategori').val('');
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
                        var option = $('<option></option>').val(tag.id).text(tag.tag);
                        
                        // Tambahkan baris ke dalam tabel
                        selectMenu.append(option);
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });

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

        $('#StoreForm').submit(function(event) {
            event.preventDefault(); 

            // $('#submitButton').prop('disabled', true);

            var formData = new FormData();
            formData.append('nama', $('#nama').val());
            formData.append('keterangan', $('#keterangan').val());
            if ($('#media')[0].files[0]) {
                formData.append('media', $('#media')[0].files[0]);
            }

            $.ajax({
                url: '/api/admin/media',
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
                },
            });
        });
    });
</script>
@endsection
