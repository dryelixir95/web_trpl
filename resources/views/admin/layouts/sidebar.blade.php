<nav class="sidebar sidebar-offcanvas mt-3" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{route ('dashboard')}}" id="berandaLink">
                <i class="fa-solid fa-house menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item mt-3" style="background-color: #FFC100; border-radius: 10px;">
            <div class="row p-2 ml-2">
                <span class="menu-title">Master</span>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route ('user.index')}}">
                <i class="fa-solid fa-user menu-icon"></i>
                <span class="menu-title">User</span>
            </a>
        </li>
        <li class="nav-item mt-4" style="background-color: #FFC100; border-radius: 10px;">
            <div class="row p-2 ml-2">
                <span class="menu-title">Menu</span>
            </div>
        </li>
        @if(Auth::user()->role == 'Admin')
        <li class="nav-item dropdown">
            <a class="nav-link" href="#" data-toggle="dropdown">
                <i class="fa-solid fa-cube menu-icon"></i>
                <span class="menu-title">Beranda</span>
            </a>
            <div class="submenu d-none">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('berita.index') }}">
                            <i class="fa-solid fa-bars menu-icon"></i>
                            <span class="menu-title">Berita Terbaru</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('fasilitas.index')}}">
                            <i class="fa-solid fa-bars menu-icon"></i>
                            <span class="menu-title">Fasilitas</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('akreditasi.index') }}">
                            <i class="fa-solid fa-bars menu-icon"></i>
                            <span class="menu-title">Akreditasi</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('kerjasama_mitra.index')}}">
                            <i class="fa-solid fa-bars menu-icon"></i>
                            <span class="menu-title">Kerjasama Mitra</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" href="#" data-toggle="dropdown">
                <i class="fa-solid fa-cube menu-icon"></i>
                <span class="menu-title">Profil Prodi</span>
            </a>
            <div class="submenu d-none">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('sejarah.index')}}">
                            <i class="fa-solid fa-bars menu-icon"></i>
                            <span class="menu-title">Sejarah TRPL</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('visi_misi_tujuan.index')}}">
                            <i class="fa-solid fa-bars menu-icon"></i>
                            <span class="menu-title">Visi, Misi, Tujuan TRPL</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('kurikulum.index')}}">
                            <i class="fa-solid fa-bars menu-icon"></i>
                            <span class="menu-title">Kurikulum</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('akreditasi.index') }}">
                            <i class="fa-solid fa-bars menu-icon"></i>
                            <span class="menu-title">Akreditasi</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('fasilitas.index') }}">
                            <i class="fa-solid fa-bars menu-icon"></i>
                            <span class="menu-title">Fasilitas</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dosen-staff.index')}}">
                            <i class="fa-solid fa-bars menu-icon"></i>
                            <span class="menu-title">Dosen dan Staff</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('struktur-organisasi.index')}}">
                            <i class="fa-solid fa-bars menu-icon"></i>
                            <span class="menu-title">Struktur Organisasi</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" href="#" data-toggle="dropdown">
                <i class="fa-solid fa-cube menu-icon"></i>
                <span class="menu-title">Kemahasiswaan</span>
            </a>
            <div class="submenu d-none">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('kegiatan.index')}}">
                            <i class="fa-solid fa-bars menu-icon"></i>
                            <span class="menu-title">Kegiatan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('prestasi.index')}}">
                            <i class="fa-solid fa-bars menu-icon"></i>
                            <span class="menu-title">Prestasi</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dokumen-mutu.index')}}">
                <i class="icon-folder menu-icon"></i>
                <span class="menu-title">Dokumen Mutu</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('magang-kerja-industri.index')}}">
                <i class="icon-folder menu-icon"></i>
                <span class="menu-title">Dokumen MKI</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('tugas-akhir.index')}}">
                <i class="icon-folder menu-icon"></i>
                <span class="menu-title">Dokumen TA</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('surat-edar.index')}}">
                <i class="icon-folder menu-icon"></i>
                <span class="menu-title">Surat Edar Mahasiswa</span>
            </a>
        </li>
        @endif
        @if(Auth::user()->role == 'Kaprodi')
        <li class="nav-item dropdown">
            <a class="nav-link" href="#" data-toggle="dropdown">
                <i class="fa-solid fa-cube menu-icon"></i>
                <span class="menu-title">Beranda</span>
            </a>
            <div class="submenu d-none">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-bars menu-icon"></i>
                            <span class="menu-title">Berita Terbaru</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-bars menu-icon"></i>
                            <span class="menu-title">Fasilitas</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('akreditasi.index') }}">
                            <i class="fa-solid fa-bars menu-icon"></i>
                            <span class="menu-title">Akreditasi</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-bars menu-icon"></i>
                            <span class="menu-title">Kerjasama Mitra</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        @endif
    </ul>
</nav>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('[data-toggle="dropdown"]').on('click', function(event) {
            event.preventDefault();
            var submenu = $(this).next('.submenu');
            submenu.toggleClass('d-none');
        });
    });
</script>
