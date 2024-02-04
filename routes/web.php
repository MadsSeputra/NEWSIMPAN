<?php

use App\Http\Controllers\dashboard;
// setiap membuat controller baru harus import class
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiUser;
use App\Http\Controllers\AuthController;
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
Route::get('/', function () {
    return view('post_admin/dashboard');
});

//route data sarana
// Route::get('/datasarana', function () {
//     return view('post_admin/data_sarana');
// });



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [dashboard::class, 'dashboard'])->name('dashboard');

//nyambungin roots di controller data sarana ke view
// -> name (' nama route ')
Route::get('/datasarana', [MasterDataController::class, 'datasarana'])->name('datasarana');
Route::get('/tambahdatasarana', [MasterDataController::class, 'tambahdatasarana'])->name('tambahdatasarana');
Route::post('/datasarana-insert', [MasterDataController::class, 'store'])->name('insert-datasarana');
Route::get('/edit_datasarana/{id}', [MasterDataController::class, 'edit'])->name('editdatasarana');
Route::put('/update_datasarana/{id}', [MasterDataController::class, 'update'])->name('updatedatasarana');
Route::delete('/delete_datasarana/{id}', [MasterDataController::class, 'delete'])->name('data.delete');


Route::get('/datapeminjam', [MasterDataController::class, 'datapeminjam'])->name('datapeminjam');

// Jembatan penghubung controler side admin transaksi dengan View admin 
Route::get('/transaksipeminjaman', [SideAdminTransaksi::class, 'transaksipeminjaman'])->name('transaksipeminjaman');
Route::get('/transaksipengembalian', [SideAdminTransaksi::class, 'transaksipengembalian'])->name('transaksipengembalian');

//Jembatan hub controller SideAdmin Laporan 
Route::get('/laporanpeminjaman', [SideAdminLaporan::class, 'laporanpeminjaman'])->name('laporanpeminjaman');
Route::get('/laporanpengembalian', [SideAdminLaporan::class, 'laporanpengembalian'])->name('laporanpengembalian');

// Jembatan penghubungan controller informasi sarana
Route::get('/informasisaranauser', [InformasiSaranaUser::class, 'informasisaranauser'])->name('informasisaranauser');

//Jembatan penghubung antara controller Transaksi user ke view post_admin/transaksi_user
Route:: get('/transaksiuser', [TransaksiUser::class, 'transaksiuser'])->name('transaksiuser');

//controller LOGIN ke view login
Route:: get('/login', [AuthController::class, 'login'])->name('login');

//controller Register ke view register
Route:: get('/register', [AuthController::class, 'register'])->name('register');