<?php

use Illuminate\Support\Facades\Route;
// setiap membuat controller baru harus import class
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

//nyambungin roots di controller data sarana ke view
// -> name (' nama route ')
Route::get('/datasarana', [MasterDataController::class, 'datasarana'])->name('datasarana');
Route::get('/datapeminjam', [MasterDataController::class, 'datapeminjam'])->name('datapeminjam');
Route::get('/transaksipeminjaman', [MasterDataController::class, 'transaksipeminjaman'])->name('transaksipeminjaman');
Route::get('/transaksipengembalian', [MasterDataController::class, 'transaksipengembalian'])->name('transaksipengembalian');
Route::get('/laporanpeminjaman', [MasterDataController::class, 'laporanpeminjaman'])->name('laporanpeminjaman');
Route::get('/laporanpengembalian', [MasterDataController::class, 'laporanpengembalian'])->name('laporanpengembalian');
Route::get('/laporansarana', [MasterDataController::class, 'laporansarana'])->name('laporansarana');
