<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SideAdminTransaksi extends Controller
{
    // setelah selesai atur controller atur routes web .php
    //controller menu transaksi peminjaman
    public function transaksipeminjaman()
    {
        return view ('post_admin/transaksi_peminjaman');
    }
    //controller menu transaksi pengembalian
    public function transaksipengembalian()
    {
        return view ('post_admin/transaksi_pengembalian');
    }
}
