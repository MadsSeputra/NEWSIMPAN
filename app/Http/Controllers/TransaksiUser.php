<?php

namespace App\Http\Controllers;

use App\Models\Dbsarana;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TransaksiUser extends Controller
{
    public function transaksiuser()
    {
        $peminjamans = Peminjaman::with(['userLog', 'dbsarana'])->get();
               // Menghitung nomor urut pada halaman saat ini
               $currentPage = request()->get('page', 1);
               $itemsPerPage = 5;
               $startNumber = ($currentPage - 1) * $itemsPerPage + 1;
            
        return view('post_admin/transaksi_user/transaksi_user', [
            'peminjamans' => $peminjamans,
            'startNumber' => $startNumber,
        ]);

    }

    public function tambahpengajuan()
    {

        $tambahpengajuan = Peminjaman::all();
        $dbsaranas = Dbsarana::all();

        return view('post_admin.transaksi_user.tambah_pengajuan', [
            'dbsaranas' => $dbsaranas]
        );
    }

    public function store(Request $request)
    {  

            // $mobil = Mobil::create($request->all());
            // if ($mobil) {
            //     Session::flash('status', 'success');
            //     Session::flash('message', 'Tambah Data Mobil Berhasil');
            //     return redirect()->route('mobil');
            // } else {
            //     return redirect()->back()->withErrors(['Gagal menambahkan data mobil.']);
            // }
        
        $peminjamans = Peminjaman::create($request->all());
        if ($peminjamans) {
            Session::flash('status', 'success');
            Session::flash('message', 'Tambah Data Sarana Berhasil');
            return redirect()->route('transaksiuser');
        } else {
            return redirect()->back()->withErrors(['Gagal menambahkan data sarana.']);
        }
    }

        // Validasi input
    //     $request->validate([
    //         'no_telp' => 'required',
    //         'id_dbsarana' => 'required',
    //         'jumlah_sarana' => 'required',
    //         'tanggal_pinjam' => 'required',
    //         'tanggal_kembali' => 'required',
    //         'keterangan' => 'required',
    //     ]);

    //     Peminjaman::create([
    //         'id_transaksi' => $request->id_transaksi,
    //         'id_userlog' => Auth::id(),
    //         'no_telp' => $request->no_telp,
    //         'id_dbsarana' => $request->id_dbsarana,
    //         'jumlah_sarana' => $request->jumlah_sarana,
    //         'tanggal_pinjam' => $request->tanggal_pinjam,
    //         'tanggal_kembali' => $request->tanggal_kembali,
    //         'keterangan' => $request->keterangan,
    //         'status' => 'Belum Terkonfirmasi',
    //     ]);

    //     return redirect()->route('transaksiuser')->with('status', 'Pengajuan berhasil diajukan');
    // }
    
}
