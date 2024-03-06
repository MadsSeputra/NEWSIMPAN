<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\View;

class SideAdminLaporan extends Controller
{
    // setelah selesai atur controller atur routes web .php
    public function laporanpeminjamanbatal()
    {
        $batal = Peminjaman::with(['userLog', 'dbsarana'])
        ->where('status', 'DIBATALKAN')
        ->get();
        // Menghitung nomor urut pada halaman saat ini
        $currentPage = request()->get('page', 1);
        $itemsPerPage = 5;
        $startNumber = ($currentPage - 1) * $itemsPerPage + 1;
     
        return view('post_admin/laporan_peminjamanbatal', compact('batal', 'startNumber'));
    }

    public function laporanpengembalian()
    {
        $pengembalian = Peminjaman::with(['userLog', 'dbsarana'])
        ->where('status', 'SELESAI')
        ->get();
        // Menghitung nomor urut pada halaman saat ini
        $currentPage = request()->get('page', 1);
        $itemsPerPage = 5;
        $startNumber = ($currentPage - 1) * $itemsPerPage + 1;
     
        return view('post_admin/laporan_pengembalian', compact('pengembalian', 'startNumber'));
    }

    public function lihatcetakpengembalian($tahun, $bulan)
    {
        // Konversi tahun dan bulan menjadi format Carbon
        $tanggal = Carbon::create($tahun, $bulan, 1);

        $pengembalian = Peminjaman::with(['userLog', 'dbsarana'])
            ->where('status', 'SELESAI')
            ->whereYear('tanggal_pinjam', $tanggal->year)
            ->whereMonth('tanggal_pinjam', $tanggal->month)
            ->get();

        // Menghitung nomor urut pada halaman saat ini
        $currentPage = request()->get('page', 1);
        $itemsPerPage = 5;
        $startNumber = ($currentPage - 1) * $itemsPerPage + 1;

        return view('post_admin.cetak_pengembalian', compact('pengembalian', 'tanggal', 'startNumber'));
    }

    public function cetakpengembalian($tahun, $bulan)
    {
        // Konversi tahun dan bulan menjadi format Carbon
        $tanggal = Carbon::create($tahun, $bulan, 1);

        $pengembalian = Peminjaman::with(['userLog', 'dbsarana'])
            ->where('status', 'SELESAI')
            ->whereYear('tanggal_pinjam', $tanggal->year)
            ->whereMonth('tanggal_pinjam', $tanggal->month)
            ->get();

        // Menghitung nomor urut pada halaman saat ini
        $currentPage = request()->get('page', 1);
        $itemsPerPage = 5;
        $startNumber = ($currentPage - 1) * $itemsPerPage + 1;

        // Render view ke dalam HTML
        $html = View::make('post_admin.cetak_pengembalian', compact('pengembalian', 'tanggal', 'startNumber'))->render();

        // Buat instance Dompdf
        $dompdf = new Dompdf();
        
        // Load HTML ke dalam Dompdf
        $dompdf->loadHtml($html);

        // Atur ukuran dan orientasi halaman
        $dompdf->setPaper('A4', 'landscape');

        // Render HTML ke dalam PDF
        $dompdf->render();

        // Kembalikan file PDF sebagai respons
        return $dompdf->stream('laporan-pengembalian.pdf');
    }
}