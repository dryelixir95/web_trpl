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
        border: 1;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    .card-img {
        border-right: 1px solid #ddd;
        max-width: 100%;
        height: 100%;
        object-fit: cover; /* Ensures that the image covers the entire area */
        max-height: 200px; /* You can adjust this value as needed */

    }
    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }
    .card-title {
        font-size: 1rem; /* Adjust the font size if needed */
        line-height: 1.2;
        height: 2.4rem; /* Two lines height */
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        display: -webkit-box;
        -webkit-line-clamp: 2; /* Limits the title to 2 lines */
        -webkit-box-orient: vertical;
    }

    .card-text {
        flex-grow: 1;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 3; /* Limits the description to 3 lines */
        -webkit-box-orient: vertical;
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
            <h3 class="mt-3 mb-4 text-center"><b id="page-title"></b></h3>
            <div class="container">
                <div class="mt-2 mb-2" id="content"></div> 
            </div>
            <div class="container">
                <div class="row" id="card-container"></div>
            </div>
        </div>
        <div class="col-md-4 shadow bg-light d-none d-md-block">
            <h3 class="mt-3 text-center"><b>Kalender</b></h3>
            <div id="calendar-container" class="mb-4">
                <div id="my-calendar"></div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    var kategoriHalaman = window.location.pathname.split('/').pop();
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
        url: '/api/public/kategori-post', 
        method: 'GET',
        success: function(data) {
            data.kategori.forEach(function(kategori) {
                if (kategori.slug === kategoriHalaman) {
                    // Set the page title
                    $('#page-title').text(kategori.nama);

                    if (kategori.type_halaman === 'multi-artikel') {
                        $.ajax({
                            url: `/api/public/post`,
                            method: 'GET',
                            success: function(data) {
                                var filteredPosts = data.posts.filter(post => post.kategori === kategori.id);
                                
                                filteredPosts.sort(function(a, b) {
                                    // Parse the 'tanggal' field (YYYY-MM-DD)
                                    var dateA = new Date(a.tanggal);
                                    var dateB = new Date(b.tanggal);

                                    // Compare the 'tanggal' first
                                    if (dateA.getTime() !== dateB.getTime()) {
                                        return dateB - dateA; // Newer dates first
                                    } else {
                                        // If 'tanggal' is the same, compare by 'created_at'
                                        var createdAtA = new Date(a.created_at);
                                        var createdAtB = new Date(b.created_at);
                                        return createdAtB - createdAtA; // Newer timestamps first
                                    }
                                });

                                $('#card-container').empty();

                                // Generate card HTML
                                filteredPosts.forEach(function(post) {
                                    var parsedDescription = marked.parse(post.deskripsi);
                                    var plainTextDescription = stripHtml(parsedDescription).substring(0, 100);

                                    var imageUrl = post.deskripsi.match(/!\[\]\((.*?)\)/) ? post.deskripsi.match(/!\[\]\((.*?)\)/)[1] : '/default-image.jpg';

                                    var cardHtml = `
                                        <div class="col-12 mb-4">
                                            <div class="card h-100">
                                                <div class="row g-0">
                                                    <div class="col-md-4 p-1 d-flex align-items-center">
                                                        <img src="${imageUrl}" class="card-img img-fluid" alt="${post.judul}">
                                                    </div>
                                                    <div class="col-md-8 shadow bg-light" style="border-radius: 10px;">
                                                        <div class="card-body">
                                                            <h5 class="card-title">${post.judul}</h5>
                                                            <p class="card-text">${plainTextDescription}...</p>
                                                            <a href="/${kategoriHalaman}/${post.id}" class="read-more">Baca Selengkapnya</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    `;
                                    $('#card-container').append(cardHtml);
                                });    
                                // ini bisa ditaruh di detail atas, <a href="/${kategoriHalaman}/${post.id}" class="read-more" target="_blank">Read More</a>
                            },
                            error: function(xhr, status, error) {
                                console.error('There was a problem with the AJAX request:', error);
                            }
                        });
                    } else if (kategori.type_halaman === 'single-artikel') {
                        $.ajax({
                            url: `/api/public/post/${kategori.id}/artikel`,
                            method: 'GET',
                            success: function(data) {
                                // Convert markdown to HTML using marked
                                var htmlContent = marked.parse(data.post.deskripsi);
                                $('#content').html(htmlContent);

                                // Add img-fluid and text-center classes to images and surrounding elements in #content
                                $('#content img').addClass('img-fluid').parent().addClass('text-center');
                                $('#content h4, #content h3, #content h2 ').addClass('text-center');

                                // Add target="_blank" to all links in #content
                                $('#content a').attr('target', '_blank');

                                // If there are tables in the content, wrap them with .table-responsive and add .table class
                                if ($('#content table').length > 0) {
                                    $('#content').wrap('<div class="table-responsive text-center"></div>');
                                    $('#content table').addClass('table table-bordered');
                                    $('#content table td figure img').addClass('img-fluid');

                                    // Add .table-header class to the first row
                                    $('#content table tr:first').addClass('table-header');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('There was a problem with the AJAX request:', error);
                            }
                        });
                    }
                }
            });
        },
        error: function(xhr, status, error) {
            console.error('There was a problem with the AJAX request:', error);
        }
    });
});
</script>
@endsection
