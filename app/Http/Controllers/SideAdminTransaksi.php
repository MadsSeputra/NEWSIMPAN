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
        // Mengambil peminjaman dengan status 'DALAM-PROSES'
        $peminjamans = Peminjaman::with(['userLog', 'dbsarana'])
        ->where('status', 'DALAM-PROSES')
        ->get();

        $peminjamanditerima = Peminjaman::with(['userLog', 'dbsarana'])
        ->where('status', 'DITERIMA')
        ->get();
        // Menghitung nomor urut pada halaman saat ini
        $currentPage = request()->get('page', 1);
        $itemsPerPage = 5;
        $startNumber = ($currentPage - 1) * $itemsPerPage + 1;
     
        return view('post_admin/transaksi_peminjaman', compact('peminjamans', 'startNumber', 'peminjamanditerima'));

        
        
    }
    //controller menu transaksi pengembalian
    public function transaksipengembalian()
    {
        return view ('post_admin/transaksi_pengembalian');
    }

    public function processKonfirmasiPeminjaman(Request $request, $id)
    {
        $konfirmasipeminjaman = Peminjaman::findOrFail($id);

        // Validasi input form konfirmasi pemesanan
        $request->validate([
            'status' => 'required|in:DITERIMA' // Sesuaikan dengan opsi status yang diizinkan
        ]);
        // Ubah status pemesanan pada pemesanan yang terkait
        $konfirmasipeminjaman->status = $request->status;
        $konfirmasipeminjaman->save();
    
        // Ubah status pemesanan pada batal pesanan itu sendiri
        // $konfirmasiPesanan->status_pemesanan = $request->status_pemesanan;
        // $konfirmasiPesanan->save();

        // Mail::to($request->recipient_email) // Menggunakan alamat email penerima dari input form
        //     ->send(new SendEmail($data));

        return redirect()->route('transaksipeminjaman')->with('konfirmasi', 'Konfirmasi pesanan berhasil');
    }
}
