<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SideAdminLaporan extends Controller
{
    // setelah selesai atur controller atur routes web .php
    public function laporanpeminjaman()
    {
        return view ('post_admin/laporan_peminjaman');
    }

    public function laporanpengembalian()
    {
        return view ('post_admin/laporan_pengembalian');
    }

  
}
