<style>
    .dropdown-toggle::after {
        margin-left: auto;
        margin-right: 0;
        right: 13px;
        position: absolute;
    }
</style>

<nav class="sidebar sidebar-offcanvas mt-1" id="sidebar">
    <ul class="nav" id="menu">
        <li class="nav-item">
            <a class="nav-link" href="{{route ('dashboard')}}" id="berandaLink">
                <i class="fa-solid fa-house menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item mt-2" style="background-color: #FFC100; border-radius: 10px;">
            <div class="row p-2 ml-2">
                <span class="menu-title">Master</span>
            </div>
        </li>
        @if(Auth::user()->role == 'Admin')
        <li class="nav-item">
            <a class="nav-link" href="{{route ('user.index')}}">
                <i class="fa-solid fa-user menu-icon"></i>
                <span class="menu-title">User</span>
            </a>
        </li>
        @endif
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="postDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa-solid fa-paper-plane menu-icon"></i>
                <span class="menu-title">Post</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="postDropdown">
                <a class="dropdown-item" href="{{ route('post.index') }}">List Post</a>
                <a class="dropdown-item" href="{{ route('kategori-post.index') }}">Kategori</a>
                <a class="dropdown-item" href="{{ route('tag.index') }}">Tag</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="mediaDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa-solid fa-folder menu-icon"></i>
                <span class="menu-title">Media</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="mediaDropdown">
                <a class="dropdown-item" href="{{ route('media.index') }}">Semua</a>
                <a class="dropdown-item" href="{{ route('kategori-media.index') }}">Kategori</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="postDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa-solid fa-feather menu-icon"></i>
                <span class="menu-title">Halaman</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="postDropdown">
                <a class="dropdown-item" href="{{ route('halaman.index') }}">List Halaman</a>
                <a class="dropdown-item" href="{{ route('kategori-halaman.index') }}">Kategori</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route ('setting.index')}}">
                <i class="fa-solid fa-gear menu-icon"></i>
                <span class="menu-title">Setting</span>
            </a>
        </li>

        @if(Auth::user()->role == 'Admin')
        <li class="nav-item">
            <a class="nav-link" href="{{route ('menu.index')}}">
                <i class="fa-solid fa-cube menu-icon"></i>
                <span class="menu-title">Master Menu</span>
            </a>
        </li>
        @endif

        <li class="nav-item mt-4" style="background-color: #FFC100; border-radius: 10px;">
            <div class="row p-2 ml-2">
                <span class="menu-title">Menu</span>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('beranda.index')}}">
                <i class="fa-solid fa-cube menu-icon"></i>
                <span class="menu-title">Beranda</span>
            </a>
        </li>
        <!-- menu -->
    </ul>
</nav>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $.ajax({
            url: '/api/admin/menu',
            method: 'GET',
            success: function(data) {
                if (Array.isArray(data.menu)) {
                    var sidebar = $('#menu');

                    // Iterasi setiap user dalam data
                    data.menu.forEach(function(menu) {
                        // Buat baris tabel baru
                        var li = $('<li class="nav-item" data-id="' + menu.id + '"></li>');
                        var nama_menu = menu.nama_menu;
                        var formattedUrl = nama_menu.toLowerCase().split(' ').join('-');

                        // Tambahkan data kolom
                        li.append('<a class="nav-link" href="' + '/admin/'+ formattedUrl + '"><i class="fa-solid fa-cube menu-icon"></i><span class="menu-title">'+ menu.nama_menu +'</span></a>');
                        // Tambahkan baris ke dalam tabel
                        sidebar.append(li);
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });
    });
</script>
