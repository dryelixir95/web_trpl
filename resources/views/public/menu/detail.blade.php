@extends('public.app')
@section('content')
<style>
    #content img.img-fluid {
        max-width: 55%;
        height: auto;
    }
    .table-header {
        background-color: #ebff2c;
        font-weight: bold;
    }
    #calendar-container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    #my-calendar {
        width: 100%;
        max-width: 400px; 
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .card {
        border: 0;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    .card-img {
        border-right: 1px solid #ddd;
        max-width: 100%;
    }
    .card-body {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .read-more {
        display: block;
        margin-top: 20px;
        padding-top: 10px;
        border-top: 1px solid #ddd;
        color: #007bff;
        text-decoration: none;
    }
</style>
<div class="container" style="padding-top: 5rem;">
    <div class="row">
        <div class="col-md-8 col-sm-12">
        <!-- <div class="col-md-8 col-sm-12" style="background-color: #f3ff7a63;"> -->
            <h3 class="mt-3 mb-4 text-center"><b id="page-title"></b></h3>
            <div class="container">
                <div class="mt-2 mb-2" id="content"></div> 
            </div>
            <div class="container">
                <div class="row" id="card-container"></div>
            </div>
        </div>
        <div class="col-md-4 shadow bg-light d-sm-none d-lg-block d-md-block">
            <h3 class="mt-3 text-center"><b>Kalender</b></h3>
            <div id="calendar-container" class="mb-4">
                <div id="my-calendar"></div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    var PostId = window.location.pathname.split('/').pop();

    var element = document.getElementById("my-calendar");
    
    // Create the calendar
    var myCalendar = jsCalendar.new({
        target : element,
        navigator : true,
        navigatorPosition : "right",
        monthFormat : "month YYYY",
        dayFormat : "DDD",
        language : ""
    });

    function stripHtml(html) {
        var doc = new DOMParser().parseFromString(html, 'text/html');
        return doc.body.textContent || "";
    }


    $.ajax({
        url: `/api/public/post/edit/${PostId}`,
        method: 'GET',
        success: function(data) {
            $('#page-title').text(data.post.judul);

            // Konversi markdown ke HTML menggunakan marked
            var htmlContent = marked.parse(data.post.deskripsi);
            $('#content').html(htmlContent);

            // Tambahkan kelas img-fluid dan text-center ke semua gambar di dalam #content
            $('#content img').addClass('img-fluid').parent().addClass('text-center');
            $('#content h4, #content h3, #content h2 ').addClass('text-center');

            // Tambahkan atribut target="_blank" ke semua link di dalam #content
            $('#content a').attr('target', '_blank');

            // Jika ada tabel di dalam konten, bungkus dengan .table-responsive dan tambahkan kelas table
            if ($('#content table').length > 0) {
                $('#content').wrap('<div class="table-responsive text-center"></div>');
                $('#content table').addClass('table table-bordered');
                $('#content table td figure img').addClass('img-fluid');

                // Tambahkan kelas table-header ke elemen td pada baris pertama
                $('#content table tr:first').addClass('table-header');
            }
        },
        error: function(xhr, status, error) {
            console.error('There was a problem with the AJAX request:', error);
        }
    });
});
</script>
@endsection
