<?php


use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Auth\LogoutController;
use App\Http\Controllers\Web\Auth\RegisterController;
use App\Http\Controllers\Web\CetakLaporan\CetakLaporanController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\KelolaAbsensi\HasilAbsensi\EditHasilAbsensiController;
use App\Http\Controllers\Web\KelolaAbsensi\HasilAbsensi\KelolaHasilAbsensiController;
use App\Http\Controllers\Web\KelolaAbsensi\PengajuanIzin\KelolaPengajuanIzinController;
use App\Http\Controllers\Web\KelolaAbsensi\LaporanAbsensi\KonfirmasiLaporanAbsensiController;
use App\Http\Controllers\Web\KelolaAbsensi\PengajuanIzin\KonfirmasiPengajuanIzinController;
use App\Http\Controllers\Web\KelolaMading\EditMadingController;
use App\Http\Controllers\Web\KelolaMading\KelolaMadingController;
use App\Http\Controllers\Web\KelolaUser\KelolaAdminController;
use App\Http\Controllers\Web\KelolaUser\KelolaPegawaiController;
use App\Http\Controllers\Web\KelolaAbsensi\LaporanAbsensi\KelolaLaporanAbsensiController;
use App\Http\Controllers\Web\KelolaWaktuKerja\KelolaWaktuKerjaController;
use App\Http\Controllers\Web\KelolaWaktuKerja\TambahHariLiburController;
use App\Http\Controllers\Web\KelolaWaktuKerja\UbahJamKerjaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return redirect()->route('admin.login');
});

//Register
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/do-register',[RegisterController::class,'register'])->name('doregister');

//Guest
Route::prefix('admin')->name('admin.')->middleware('guest:admin')->group(function (){
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/do-login',[LoginController::class,'login'])->name('dologin');
});

//Logined
Route::prefix('admin')->name('admin.')->middleware('auth.admin')->group(function (){
//    Dashboard
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
//    Mading
    Route::get('/mading', [KelolaMadingController::class, 'index'])->name('halaman.mading');
    Route::get('/car-mading', [KelolaMadingController::class, 'cariMading'])->name('cari.mading');
    Route::get('/tambah-mading', [KelolaMadingController::class, 'tambahMadingPage'])->name('halaman.tambah.mading');
    Route::post('/tambah-mading', [KelolaMadingController::class, 'tambahMading'])->name('tambah.mading');
    Route::get('/lihat-mading/{id}',[KelolaMadingController::class, 'lihatMadingPage'])->name('lihat.mading');
    Route::get('/edit-mading/{id}', [EditMadingController::class, 'index'])->name('halaman.edit.mading');
    Route::post('/edit-mading/{id}', [EditMadingController::class, 'editMading'])->name('edit.mading');
    Route::post('/hapus-mading/{id}', [EditMadingController::class, 'hapusMading'])->name('hapus.mading');

//    Kelola Absensi
    //Hasil Absensi
    Route::get('/kelola-asbensi', [KelolaHasilAbsensiController::class, 'index'])->name('halaman.kelola.hasil.absensi');
    Route::get('/cari-hasil-absensi',[KelolaHasilAbsensiController::class, 'cariHasilAbsensi'])->name('cari.hasil.absensi');
    Route::get('/edit-absensi/{id}',[EditHasilAbsensiController::class,'index'])->name('halaman.edit.absensi');
    Route::post('/edit-absensi/{id}',[EditHasilAbsensiController::class,'editAbsensi'])->name('edit.absensi');
    Route::post('/hapus-absensi/{id}',[EditHasilAbsensiController::class,'hapus'])->name('hapus.absensi');
    //Pengajuan Izin
    Route::get('/pengajuan-izin', [KelolaPengajuanIzinController::class, 'index'])->name('halaman.kelola.pengajuan.izin');
    Route::get('/pengajuan-izin/{id}', [KonfirmasiPengajuanIzinController::class, 'index'])->name('halaman.konfirmasi.pengajuan.izin');
    Route::post('/tolak-pengajuan-izin/{id}', [KonfirmasiPengajuanIzinController::class, 'tolak'])->name('tolak.pengajuan.izin');
    Route::post('/terima-pengajuan-izin/{id}', [KonfirmasiPengajuanIzinController::class, 'terima'])->name('terima.pengajuan.izin');
    Route::get('/cari-pengajuan-izin',[KelolaPengajuanIzinController::class, 'cariPengajuanIzin'])->name('cari.pengajuan.izin');

    //Laporan Absensi
    Route::get('/laporan-absensi', [KelolaLaporanAbsensiController::class, 'index'])->name('halaman.kelola.laporan.absensi');
    Route::get('/cari-laporan-absensi',[KelolaLaporanAbsensiController::class, 'cariLaporanAbsensi'])->name('cari.laporan.absensi');
    Route::get('/konfirmasi-laporan-absensi/{id}',[KonfirmasiLaporanAbsensiController::class, 'index'])->name('halaman.konfirmasi.laporan.absensi');
    Route::post('/tolak-laporan-absensi/{id}', [KonfirmasiLaporanAbsensiController::class, 'tolak'])->name('tolak.laporan.absensi');
    Route::post('/terima-laporan-absensi/{id}', [KonfirmasiLaporanAbsensiController::class, 'terima'])->name('terima.laporan.absensi');
    Route::get('/cari-absensi/{id}/{tanggal_absen}', [KonfirmasiLaporanAbsensiController::class, 'cariAbsensi'])->name('cari.absensi');
    Route::post('/tambah-absensi/{id}', [KonfirmasiLaporanAbsensiController::class, 'tambahAbsen'])->name('tambah.absensi');

//    Cetak Laporan
    Route::get('/cetak-laporan', [CetakLaporanController::class, 'index'])->name('halaman.cetak.laporan');


//    Kelola User
    //Pegawai
    Route::get('/kelola-pegawai',[KelolaPegawaiController::class,'index'])->name('kelola.pegawai');
    Route::get('/cari-pegawai',[KelolaPegawaiController::class,'cariPegawai'])->name('cari.pegawai');
    Route::get('/edit-pegawai/{id}',[KelolaPegawaiController::class,'editpage'])->name('halaman.edit.pegawai');
    Route::post('/edit-pegawai/{id}',[KelolaPegawaiController::class,'editpegawai'])->name('edit.pegawai');
    Route::get('/tambah-pegawai',[KelolaPegawaiController::class,'tambahpage'])->name('halaman.tambah.pegawai');
    Route::post('/tambahkan-pegawai',[KelolaPegawaiController::class,'tambahkan'])->name('tambahkan.pegawai');
    Route::post('/hapus-pegawai/{id}',[KelolaPegawaiController::class,'hapus'])->name('hapus.pegawai');

    //Admin
    Route::get('/kelola-admin',[KelolaAdminController::class,'index'])->name('kelola.admin');
    Route::post('/hapus-admin/{email}',[KelolaAdminController::class,'hapus'])->name('hapus.admin');
    Route::post('/edit-admin/{id}',[KelolaAdminController::class,'editadmin'])->name('edit.admin');
    Route::get('/tambah-admin',[KelolaAdminController::class,'tambahpage'])->name('halaman.tambah.admin');
    Route::get('/edit-admin/{id}',[KelolaAdminController::class,'editpage'])->name('halaman.edit.admin');

//    Kelola Waktu Kerja
    Route::get('/kelola-waktu-kerja', [KelolaWaktuKerjaController::class, 'index'])->name('halaman.kelola.waktu.kerja');

    //Hari Libur
    Route::post('/tambah-hari-libur', [TambahHariLiburController::class, 'tambah'])->name('tambah.hari.libur');
    Route::post('/ubah-jam-kerja', [UbahJamKerjaController::class, 'ubah'])->name('ubah.jam.kerja');

//    Logout
    Route::post('/logout',[LogoutController::class,'logout'])->name('logout');
});
