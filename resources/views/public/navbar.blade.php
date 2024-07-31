<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="{{asset('src/images/LOGO_poliwangi.jpeg')}}" style="width: 50px; height: auto;" alt="Logo"> <span>POLIWANGI</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Beranda</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profilProdiDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-warehouse menu-icon"></i> Profil Prodi
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="profilProdiDropdown">
                            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-bars menu-icon"></i> Sejarah TRPL</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-bars menu-icon"></i> Visi, Misi, Tujuan TRPL</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-bars menu-icon"></i> Kurikulum</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-bars menu-icon"></i> Akreditasi</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-bars menu-icon"></i> Fasilitas</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-bars menu-icon"></i> Dosen dan Staff</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-bars menu-icon"></i> Struktur Organisasi</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="kemahasiswaanDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-users menu-icon"></i> Kemahasiswaan
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="kemahasiswaanDropdown">
                            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-bars menu-icon"></i> Kegiatan</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-bars menu-icon"></i> Prestasi</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="kemahasiswaanDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-users menu-icon"></i> Dokumen
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="kemahasiswaanDropdown">
                            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-bars menu-icon"></i> Dokumen Mutu</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-bars menu-icon"></i> Dokumen MKI</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-bars menu-icon"></i> Dokumen TA</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-folder menu-icon"></i> Surat Edar Mahasiswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-dark me-2" href="{{route('login')}}">Sign in</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>