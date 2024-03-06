<?php

use App\Http\Controllers\dashboard;
// setiap membuat controller baru harus import class
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiUser;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\SideAdminLaporan;
use App\Http\Controllers\SideAdminTransaksi;
use App\Http\Controllers\InformasiSaranaUser;
use App\Http\Controllers\MasterDataController;

/*->name('index2'
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/tes', function () {
    return view('welcome');
});
//
// Route::get('/', function () {
//     return view('login');
// });

//route data sarana
// Route::get('/datasarana', function () {
//     return view('post_admin/data_sarana');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




Route::get('/logout', [AuthController::class, 'logout']);


Route::get('/login', [AuthController::class,'proseslogin']);

// Route::get('/home', function (){
//     return 'kamu sudah login';
// })-> middleware('auth::admin,web');

//nyambungin roots di controller data sarana ke view
// -> name (' nama route ')
Route::middleware('guest')->group(function () {
//Roots Login dan Logout
Route::get('/', [AuthController::class, 'login'])->name('login'); //fungsi name = mengubah nama route 
Route::post('login', [AuthController::class, 'proseslogin'])->name('proseslogin');

Route:: get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/registrasi', [AuthController::class, 'prosesregistrasi'])->name('prosesregistrasi');
});    
Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [dashboard::class, 'dashboard'])->name('dashboard');

    Route::get('/datasarana', [MasterDataController::class, 'datasarana'])->name('datasarana');
    Route::get('/tambahdatasarana', [MasterDataController::class, 'tambahdatasarana'])->name('tambahdatasarana');
    //route post (menyimpan data baru ke dalam sistem | ex : mengirim form untuk disimpan | Digunakan untuk CREATE)
    Route::post('/datasarana-insert', [MasterDataController::class, 'store'])->name('insert-datasarana');
    Route::get('/edit_datasarana/{id}', [MasterDataController::class, 'edit'])->name('editdatasarana');
    Route::put('/update_datasarana/{id}', [MasterDataController::class, 'update'])->name('updatedatasarana');
    Route::delete('/delete_datasarana/{id}', [MasterDataController::class, 'delete'])->name('data.delete');


    Route::get('/dataterdaftar', [MasterDataController::class, 'dataterdaftar'])->name('dataterdaftar') ;

    // Jembatan penghubung controler side admin transaksi dengan View admin 
    Route::get('/transaksipeminjaman', [SideAdminTransaksi::class, 'transaksipeminjaman'])->name('transaksipeminjaman');
    Route::get('/transaksipengembalian', [SideAdminTransaksi::class, 'transaksipengembalian'])->name('transaksipengembalian');
    Route::post('/peminjaman-konfirmasi/{id}', [SideAdminTransaksi::class, 'processKonfirmasiPeminjaman'])->name('konfirmasipeminjaman');
    Route::patch('/batal-peminjaman/{id}', [SideAdminTransaksi::class, 'batalkanPesanan'])->name('batalpeminjaman');
    Route::patch('/selesai-peminjaman/{id}', [SideAdminTransaksi::class, 'selesaikanPesanan'])->name('selesaipeminjaman');

    //Jembatan hub controller SideAdmin Laporan 
    Route::get('/laporanpeminjaman', [SideAdminLaporan::class, 'laporanpeminjamanbatal'])->name('laporanpeminjamanbatal');
    Route::get('/laporanpengembalian', [SideAdminLaporan::class, 'laporanpengembalian'])->name('laporanpengembalian');
    Route::get('lihat-pengembalian/{tahun}/{bulan}', [SideAdminLaporan::class, 'lihatcetakpengembalian'])->name('lihatpengembalian');
    Route::get('cetak-pengembalian/{tahun}/{bulan}', [SideAdminLaporan::class, 'cetakpengembalian'])->name('cetakpengembalian');
});

Route::middleware('auth:web')->group(function () {
// Jembatan penghubungan controller informasi sarana
Route::get('/informasisaranauser', [InformasiSaranaUser::class, 'informasisaranauser'])->name('informasisaranauser') ; // middleware akan berfungsi jika akun belum login maka akan di tendang ke halaman login

//Jembatan penghubung antara controller Transaksi user ke view post_admin/transaksi_user
Route:: get('/transaksiuser', [TransaksiUser::class, 'transaksiuser'])->name('transaksiuser');
Route:: get('/tambahpengajuan', [TransaksiUser::class, 'tambahpengajuan'])->name('tambahpengajuan');
Route::post('/pengajuan-insert', [TransaksiUser::class, 'store'])->name('insert-pengajuan');

//Route untuk profil user
Route:: get('/profiluser', [Usercontroller::class, 'profiluser'])->name('profiluser');


});

//controller LOGIN ke view login
//Route:: get('/login', [AuthController::class, 'login'])->name('login');

//controller Register ke view register
