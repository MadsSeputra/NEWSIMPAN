<?php

namespace App\Http\Controllers;

use App\Models\Dbsarana;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Mail\PeminjamanNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class TransaksiUser extends Controller
{
    public function transaksiuser()
    {
        // Mendapatkan id user yang sudah login
        $user = Auth::guard('web')->user();

        // Mengambil peminjaman berdasarkan id user yang sudah login
        $peminjamans =  Peminjaman::with(['userLog', 'dbsarana'])->where('id_userlog', $user->id)->get();
        // Menghitung nomor urut pada halaman saat ini
        $currentPage = request()->get('page', 1);
        $itemsPerPage = 5;
        $startNumber = ($currentPage - 1) * $itemsPerPage + 1;

        return view('post_admin.transaksi_user.transaksi_user', compact('peminjamans', 'startNumber'));
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

        $request->validate([
            'id_userlog' => 'required',
            'id_dbsarana' => 'required',
            'jumlah' => 'required|numeric|min:1',
            'tanggal_pinjam' => 'required',
            'tanggal_kembali' => 'required',
            'keterangan' => 'required', // Menambahkan aturan validasi untuk keterangan
            'status' => 'required',
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'numeric' => 'Kolom :attribute harus berupa angka.',
            'min' => [
                'numeric' => 'Kolom :attribute harus memiliki nilai minimal :min.',
            ],
        ]);

        // Periksa jumlah sarana yang tersedia
        $dbsarana = Dbsarana::find($request->id_dbsarana);
        $jumlahDipinjam = $request->jumlah;
        $jumlahTersedia = $dbsarana->jumlah_sarana - $dbsarana->jumlah_terpakai;

        if ($jumlahDipinjam > $jumlahTersedia) {
            return redirect()->back()->withErrors(['Jumlah sarana yang ingin dipinjam melebihi yang tersedia.']);
        }

        // Proses peminjaman
        $peminjaman = new Peminjaman();
        $peminjaman->id_userlog = $request->id_userlog;
        $peminjaman->id_dbsarana = $request->id_dbsarana;
        $peminjaman->jumlah = $request->jumlah;
        $peminjaman->tanggal_pinjam = $request->tanggal_pinjam;
        $peminjaman->tanggal_kembali = $request->tanggal_kembali;
        $peminjaman->keterangan = $request->keterangan;
        $peminjaman->status = $request->status;
        // Tambahan proses lainnya sesuai kebutuhan
        $peminjaman->save();

        // Mengurangi jumlah terpakai pada sarana yang dipinjam
        $dbsarana->jumlah_terpakai += $jumlahDipinjam;
        $dbsarana->save();
        // Kirim email notifikasi dengan menyertakan nama pengguna
        $adminEmail = 'simpansarmr@gmail.com'; // Ganti dengan alamat email admin Anda
        Mail::to($adminEmail)->send(new PeminjamanNotification($request->nama_peminjam)); // Menyertakan nama pengguna dalam konstruktor
        if ($peminjaman) {
            Session::flash('status', 'success');
            Session::flash('message', 'Peminjaman Berhasil !');
            return redirect()->route('transaksiuser');
        } else {
            return redirect()->back()->withErrors(['Gagal menambahkan data sarana.']);
        }
    }
}
