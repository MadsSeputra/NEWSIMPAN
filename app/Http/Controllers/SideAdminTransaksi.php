<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Mail\SendEmail;
use App\Models\Dbsarana;
use App\Models\Peminjaman;
use App\Mail\SendEmailBatal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        // Mendapatkan tanggal sekarang
        $today = Carbon::now();

        // Menghitung nomor urut pada halaman saat ini
        $currentPage = request()->get('page', 1);
        $itemsPerPage = 5;
        $startNumber = ($currentPage - 1) * $itemsPerPage + 1;
     
        return view('post_admin/peminjaman_admin/transaksi_peminjaman', compact('peminjamans', 'startNumber', 'peminjamanditerima', 'today'));

        
        
    }
    //controller menu transaksi pengembalian
    public function transaksipengembalian()
    {
        $pengembalian = Peminjaman::with(['userLog', 'dbsarana'])
        ->where('status', 'DITERIMA')
        ->get();

        // Mendapatkan tanggal sekarang
        $today = Carbon::now();

        // Menghitung nomor urut pada halaman saat ini
        $currentPage = request()->get('page', 1);
        $itemsPerPage = 5;
        $startNumber = ($currentPage - 1) * $itemsPerPage + 1;
     
        return view('post_admin/pengembalian_admin/transaksi_pengembalian', compact('pengembalian', 'startNumber', 'today'));
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
         // Kirim email konfirmasi
         $data = [
            'id_peminjam' => $konfirmasipeminjaman->id,
            'nama' => $konfirmasipeminjaman->userLog->nama,
        ];

        Mail::to($request->recipient_email) // Menggunakan alamat email penerima dari input form
            ->send(new SendEmail($data));
        return redirect()->route('transaksipeminjaman')->with('konfirmasi', 'Konfirmasi pesanan berhasil');
    }

    public function batalkanPesanan(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'DIBATALKAN';
        $peminjaman->save();

        // Mengurangi jumlah terpakai pada sarana yang dipinjam
        $sarana = Dbsarana::find($peminjaman->id_dbsarana);
        $sarana->jumlah_terpakai -= $peminjaman->jumlah;
        $sarana->save();

        $data = [
            'id_peminjam' => $peminjaman->id,
            'nama' => $peminjaman->userLog->nama,
        ];

        Mail::to($request->recipient_email) // Menggunakan alamat email penerima dari input form
            ->send(new SendEmailBatal($data));
        return redirect()->route('transaksipeminjaman')->with('batal', 'Pesanan berhasil dibatalkan.');
    }


    public function selesaikanPesanan($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'SELESAI';
        $peminjaman->save();

        // Mengurangi jumlah terpakai pada sarana yang dipinjam
        $sarana = Dbsarana::find($peminjaman->id_dbsarana);
        $sarana->jumlah_terpakai -= $peminjaman->jumlah;
        $sarana->save();

        return redirect()->route('transaksipengembalian')->with('selesai', 'Pinjaman berhasil dikembalikan.');
    }

}
