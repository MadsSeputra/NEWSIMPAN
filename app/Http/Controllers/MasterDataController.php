<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterDataController extends Controller
{
    //controller untuk menu data sarana
    public function datasarana()
    {
        return view('post_admin/data_sarana');
    }
    // function data  dan controlller untuk data peminjam
    public function datapeminjam()
    {
        return view('post_admin/data_peminjam');
    }
    // controller untuk menu transaksi 
    public function transaksipeminjaman()
    {
        return view('post_admin/transaksi_peminjaman');
    }

    public function transaksipengembalian()
    {
        return view('post_admin/transaksi_pengembalian');
    }

    public function laporanpeminjaman()
    {
        return view('post_admin/laporan_peminjaman');
    }

    public function laporanpengembalian()
    {
        return view('post_admin/laporan_pengembalian');
    }

    public function laporansarana()
    {
        return view('post_admin/laporan_sarana');
    }
}
