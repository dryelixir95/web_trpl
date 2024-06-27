<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('public.welcome');
});

Route::get('/login', function(){
    if(Auth::check()){
        return redirect()->route('dashboard');
    }
    return view('auth.login');
})->name('login');


//AdminController
Route::get('/admin', function(){
    return view('admin.dashboard');
})->name('dashboard')->middleware('checkRole:Admin;Kaprodi');

// userControllter
Route::prefix('admin/')->middleware(['checkRole:Admin'])->group(function () {
    Route::get('user/', function(){
        return view('admin.manage_user.index');
    })->name('user.index');
    Route::get('user/add', function(){
        return view('admin.manage_user.create');
    })->name('user.create');
    Route::get('user/edit/{id}', function(){
        return view('admin.manage_user.edit');
    })->name('user.edit');
});

// Beranda Menu
// BeritaController
Route::prefix('admin/')->middleware(['auth:sanctum', 'checkRole:Admin;Kaprodi'])->group(function () {
    Route::get('berita', function(){
        return view('admin.beranda.berita.index');
    })->name('berita.index');
    Route::get('berita/add', function(){
        return view('admin.beranda.berita.create');
    })->name('berita.create');
    Route::get('berita/edit/{id}', function(){
        return view('admin.beranda.berita.edit');
    })->name('berita.edit');
});

// FasilitasController
Route::prefix('admin/')->middleware(['checkRole:Admin;Kaprodi'])->group(function () {
    Route::get('fasilitas', function(){
        return view('admin.beranda.fasilitas.index');
    })->name('fasilitas.index');
    Route::get('fasilitas/add', function(){
        return view('admin.beranda.fasilitas.create');
    })->name('fasilitas.create');
    Route::get('fasilitas/edit/{id}', function(){
        return view('admin.beranda.fasilitas.edit');
    })->name('fasilitas.edit');
});

// AkreditasiController
Route::prefix('admin/')->middleware(['checkRole:Admin;Kaprodi'])->group(function () {
    Route::get('akreditasi', function(){
        return view('admin.beranda.akreditasi.index');
    })->name('akreditasi.index');

    Route::get('akreditasi/add', function(){
        return view('admin.beranda.akreditasi.create');
    })->name('akreditasi.create');

    Route::get('akreditasi/edit', function(){
        return view('admin.beranda.akreditasi.edit');
    })->name('akreditasi.edit');
});

// KerjasamaMitraController 
Route::prefix('admin/')->middleware(['auth:sanctum', 'checkRole:Admin;Kaprodi'])->group(function () {
    Route::get('/kerjasama-mitra', function(){
        return view('admin.beranda.kerjasama_mitra.index');
    })->name('kerjasama_mitra.index');
    Route::get('/kerjasama-mitra/add', function(){
        return view('admin.beranda.kerjasama_mitra.create');
    })->name('kerjasama_mitra.create');
    Route::get('/kerjasama-mitra/edit/{id}', function(){
        return view('admin.beranda.kerjasama_mitra.edit');
    })->name('kerjasama_mitra.edit');
});

// Profil Prodi Menu
// SejarahController
Route::prefix('admin/')->middleware(['auth:sanctum', 'checkRole:Admin'])->group(function () {
    Route::get('sejarah', function(){
        return view('admin.profil_prodi.sejarah.index');
    })->name('sejarah.index');
    Route::get('sejarah/add', function(){
        return view('admin.profil_prodi.sejarah.create');
    })->name('sejarah.create');
    Route::get('sejarah/edit', function(){
        return view('admin.profil_prodi.sejarah.edit');
    })->name('sejarah.edit');
});

// SejarahController
Route::prefix('admin/')->middleware(['auth:sanctum', 'checkRole:Admin'])->group(function () {
    Route::get('visi-misi-tujuan', function(){
        return view('admin.profil_prodi.visi_misi_tujuan.index');
    })->name('visi_misi_tujuan.index');
    Route::get('visi-misi-tujuan/add', function(){
        return view('admin.profil_prodi.visi_misi_tujuan.create');
    })->name('visi_misi_tujuan.create');
    Route::get('visi-misi-tujuan/edit', function(){
        return view('admin.profil_prodi.visi_misi_tujuan.edit');
    })->name('visi_misi_tujuan.edit');
});

// KurikulumController
Route::prefix('admin/')->middleware(['auth:sanctum', 'checkRole:Admin'])->group(function () {
    Route::get('kurikulum', function(){
        return view('admin.profil_prodi.kurikulum.index');
    })->name('kurikulum.index');
    Route::get('kurikulum/add', function(){
        return view('admin.profil_prodi.kurikulum.create');
    })->name('kurikulum.create');
});

// DosenStaffController
Route::prefix('admin/')->middleware(['auth:sanctum', 'checkRole:Admin'])->group(function () {
    Route::get('dosen-staff', function(){
        return view('admin.profil_prodi.dosen_staff.index');
    })->name('dosen-staff.index');
    Route::get('dosen-staff/add', function(){
        return view('admin.profil_prodi.dosen_staff.create');
    })->name('dosen-staff.create');
    Route::get('dosen-staff/edit/{id}', function(){
        return view('admin.profil_prodi.dosen_staff.edit');
    })->name('dosen-staff.edit');
});

// StrukturOrganisasiController
Route::prefix('admin/')->middleware(['auth:sanctum', 'checkRole:Admin'])->group(function () {
    Route::get('struktur-organisasi', function(){
        return view('admin.profil_prodi.struktur_organisasi.index');
    })->name('struktur-organisasi.index');
    Route::get('struktur-organisasi/add', function(){
        return view('admin.profil_prodi.struktur_organisasi.create');
    })->name('struktur-organisasi.create');
    Route::get('struktur-organisasi/edit', function(){
        return view('admin.profil_prodi.struktur_organisasi.edit');
    })->name('struktur-organisasi.edit');
});

// Kemahasiswaan menu
// KegiatanController
Route::prefix('admin/')->middleware(['auth:sanctum', 'checkRole:Admin'])->group(function () {
    Route::get('kegiatan', function(){
        return view('admin.kemahasiswaan.kegiatan.index');
    })->name('kegiatan.index');
    Route::get('kegiatan/add', function(){
        return view('admin.kemahasiswaan.kegiatan.create');
    })->name('kegiatan.create');
    Route::get('kegiatan/edit/{id}', function(){
        return view('admin.kemahasiswaan.kegiatan.edit');
    })->name('kegiatan.edit');
});

// PrestasiController
Route::prefix('admin/')->middleware(['auth:sanctum', 'checkRole:Admin'])->group(function () {
    Route::get('prestasi', function(){
        return view('admin.kemahasiswaan.prestasi.index');
    })->name('prestasi.index');
    Route::get('prestasi/add', function(){
        return view('admin.kemahasiswaan.prestasi.create');
    })->name('prestasi.create');
    Route::get('prestasi/edit/{id}', function(){
        return view('admin.kemahasiswaan.prestasi.edit');
    })->name('prestasi.edit');
});

// DMutuController
Route::prefix('admin/')->middleware(['auth:sanctum', 'checkRole:Admin'])->group(function () {
    Route::get('dokumen-mutu', function(){
        return view('admin.dokumen_mutu.index');
    })->name('dokumen-mutu.index');
    Route::get('dokumen-mutu/add', function(){
        return view('admin.dokumen_mutu.create');
    })->name('dokumen-mutu.create');
});

// MKIController
Route::prefix('admin/')->middleware(['auth:sanctum', 'checkRole:Admin'])->group(function () {
    Route::get('magang-kerja-industri', function(){
        return view('admin.dokumen_mki.index');
    })->name('magang-kerja-industri.index');
    Route::get('magang-kerja-industri/add', function(){
        return view('admin.dokumen_mki.create');
    })->name('magang-kerja-industri.create');
});

// TAController
Route::prefix('admin/')->middleware(['auth:sanctum', 'checkRole:Admin'])->group(function () {
    Route::get('tugas-akhir', function(){
        return view('admin.dokumen_ta.index');
    })->name('tugas-akhir.index');
    Route::get('tugas-akhir/add', function(){
        return view('admin.dokumen_ta.create');
    })->name('tugas-akhir.create');
});

// SEdarMahasiswaController
Route::prefix('admin/')->middleware(['auth:sanctum', 'checkRole:Admin'])->group(function () {
    Route::get('surat-edar', function(){
        return view('admin.surat_edar.index');
    })->name('surat-edar.index');
    Route::get('surat-edar/add', function(){
        return view('admin.surat_edar.create');
    })->name('surat-edar.create');
});