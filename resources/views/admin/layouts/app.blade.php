<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
   <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title id="tittleWebAdmin"></title>
  
    <link rel="shortcut icon" href="#">
  
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('/src/vendors/feather/feather.css')}}">
  <link rel="stylesheet" href="{{asset('/src/vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{asset('/src/vendors/css/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset('/src/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
  <link rel="stylesheet" href="{{asset('/src/vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('/src/js/select.dataTables.min.css')}}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('/src/css/vertical-layout-light/style.css')}}">
  <!-- endinject -->

  <!-- ckeditor5 -->
  <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.2/ckeditor5.css" />
  <link rel="stylesheet" href="{{ URL::asset('assets/vendor/main.css') }}" />

  <!-- datatables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/jquery.dataTables.min.css">

</head>
<style>
.navbar-toggler:focus {
    text-decoration: none;
    outline: 0;
    box-shadow: none;
}

.sidebar .nav .nav-item .nav-link{
  color: #000000;
}

.sidebar .nav:not(.sub-menu) {
    margin-top: 0rem;
}
.sidebar .nav {
    margin-bottom: 0px;
}
</style>
<body>
@if(Auth::check())
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar navbar-warning col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand ml-1 mr-1" href="{{ route('dashboard') }}" id="logoAdmin">
                <!-- <img src="{{ asset('/src/images/logo.svg') }}" class="mr-2" alt="logo" /> -->
            </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end flex-grow-1">
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                        <i class="fa fa-user"></i>
                        Profile
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                        <a href="#" id="logout" class="dropdown-item">
                            <i class="ti-power-off text-primary"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="icon-menu"></span>
            </button>
        </div>
    </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.layouts.sidebar')
        <!-- partial -->
        <div class="main-panel">
            @include('admin.layouts.modal')

            @yield('content')
            <footer class="footer">
                <div class="d-sm-flex justify-content">
                    <span class="text-muted">© Created by <a href="https://trpl.poliwangi.ac.id/">TRPL Poliwangi</a></span>
                </div>
            </footer>
        </div>
      </div>
    </div>
@else
    @yield('content')
@endif

  <!-- ckeditor -->
  <script type="importmap">
        {
            "imports": {
                "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/42.0.2/ckeditor5.js",
                "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/42.0.2/"
            }
        }
    </script>
    <script type="module" src="{{ URL::asset('assets/vendor/ckeditor5.js') }}"></script>
    
  <!-- plugins:js -->
  <script src="{{asset('/src/vendors/js/vendor.bundle.base.js')}}"></script>
  <script src="{{asset('/src/vendors/chart.js/Chart.min.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="{{asset('/src/vendors/datatables.net/jquery.dataTables.js')}}"></script>
  <script src="{{asset('/src/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
  <script src="{{asset('/src/js/dataTables.select.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <!-- datatables -->
  <script src="https://cdn.datatables.net/2.1.3/js/jquery.dataTables.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{asset('/src/js/off-canvas.js')}}"></script>
  <script src="{{asset('/src/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('/src/js/template.js')}}"></script>
  <script src="{{asset('/src/js/settings.js')}}"></script>
  <script src="{{asset('/src/js/todolist.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{asset('/src/js/dashboard.js')}}"></script>
  <script src="{{asset('/src/js/Chart.roundedBarCharts.js')}}"></script>
  <!-- End custom js for this page-->

<script>
    $('#logout').click(function() {
        // Membuat permintaan logout ke server
        $.ajax({
            url: '/api/logout',
            method: 'POST', 
            contentType: 'application/json',
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

    $.ajax({
        url: '/api/setting',
        method: 'GET',
        success: function(data) {
            if (Array.isArray(data.setting)) {
                var logoAdmin = $('#logoAdmin');
                var tittleWebAdmin = $('#tittleWebAdmin');

                data.setting.forEach(function(setting) {
                    if (setting.name == 'dataLogoAdmin') {
                        logoAdmin.html(`<img src="/media/${setting.value}" class="mr-2" alt="${setting.name}" />`);
                    } else if (setting.name == 'dataTittleWebAdmin') {
                        tittleWebAdmin.text(setting.value);
                    }
                });

                data.setting.forEach(function(setting) {
                    if (setting.name == 'dataIconAdmin') {
                        // Update the favicon link element
                        $('link[rel="shortcut icon"]').attr('href', '/media/' + setting.value);
                    }
                });
            }
        },
        error: function(xhr, status, error) {
            console.error('There has been a problem with your AJAX operation:', error);
        }
    });
</script>
</body>

</html>