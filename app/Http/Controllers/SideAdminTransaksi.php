<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class SideAdminTransaksi extends Controller
{
    // setelah selesai atur controller atur routes web .php
    //controller menu transaksi peminjaman
    public function transaksipeminjaman()
    {
        $peminjamans = Peminjaman::with(['userLog', 'dbsarana'])->paginate(5);
        // Menghitung nomor urut pada halaman saat ini
        $currentPage = request()->get('page', 1);
        $itemsPerPage = 5;
        $startNumber = ($currentPage - 1) * $itemsPerPage + 1;
     
        return view('post_admin/transaksi_peminjaman', [
            'peminjamans' => $peminjamans,
            'startNumber' => $startNumber,
        ]);
        
    }
    //controller menu transaksi pengembalian
    public function transaksipengembalian()
    {
        return view ('post_admin/transaksi_pengembalian');
    }
}
