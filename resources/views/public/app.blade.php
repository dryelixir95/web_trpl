<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="tittleWebPublic"></title>

    <link rel="shortcut icon" href="#">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    @include('public.navbar')
    <!-- Akhir Navbar -->

    <!-- Hero Section -->
    @yield('content')

    <!-- Footer -->
    @include('public.footer')
    <!-- Akhir Footer -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        $.ajax({
            url: '/api/admin/setting',
            method: 'GET',
            success: function(data) {
                if (Array.isArray(data.setting)) {
                    var logoPublic = $('#logoPublic');
                    var tittleWebPublic = $('#tittleWebPublic');

                    data.setting.forEach(function(setting) {
                        if (setting.name == 'dataLogoPublic') {
                            logoPublic.html(`
                            <img src="/media/${setting.value}" class="me-1" style="width: 50px; height: auto;" alt="${setting.name}">
                            <span class="brand-text" style="margin-left: 12px;">Teknologi Rekayasa<br>Perangkat Lunak</span>
                            `);
                        } else if (setting.name == 'dataTittleWebPublic') {
                            tittleWebPublic.text(setting.value);
                        }
                    });

                    data.setting.forEach(function(setting) {
                        if (setting.name == 'dataIconPublic') {
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
