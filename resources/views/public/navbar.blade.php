<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="{{asset('src/images/LOGO_poliwangi.jpeg')}}" class="me-1" style="width: 50px; height: auto;" alt="Logo">
            <span class="brand-text" style="margin-left: 12px;">Teknologi Rekayasa<br>Perangkat Lunak</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul id="navbar" class="navbar-nav ms-auto">
                <!--  menu -->
            </ul>
        </div>
    </div>
</nav>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $.ajax({
            url: '/api/public/menu',
            method: 'GET',
            success: function(data) {
                if (Array.isArray(data.menu)) {
                    var navbar = $('#navbar');
                    var beranda = `<li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Beranda</a>
                            </li>`
                    navbar.append(beranda);

                    // Iterasi setiap user dalam data
                    data.menu.forEach(function(menu) {
                        // Buat item dropdown untuk setiap menu
                        var dropdown = `
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-warehouse menu-icon"></i>${menu.nama_menu}
                                </a>
                                <ul class="dropdown-menu">`;

                        // Iterasi kategori untuk menambahkan item ke dropdown
                        data.kategori.forEach(function(kategori) {
                            if (kategori.index_menu == menu.id) {  // Misalkan `kategori.index_menu` adalah `menu.id`
                                console.log('tes')
                                dropdown += `
                                    <li><a class="dropdown-item" href="${kategori.slug}"><i class="fa-solid fa-bars menu-icon"></i> ${kategori.nama}</a></li>`;
                            }
                        });

                        dropdown += `</ul></li>`;

                        // Tambahkan item dropdown ke navbar
                        navbar.append(dropdown);
                    });

                    var login = `<li class="nav-item d-flex align-items-center">
                                <a class="btn btn-outline-dark" href="{{route('login')}}">Sign in</a>
                            </li>`

                        navbar.append(login);

                }
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });
    });
</script>

    