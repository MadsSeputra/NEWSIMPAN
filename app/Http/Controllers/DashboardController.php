<?php

namespace App\Http\Controllers;

use App\Models\AdminLog;
use App\Models\Dbsarana;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    //
    public function dashboard()
    {
        // Total jumlah sarana
        $totalSarana = Dbsarana::sum('jumlah_sarana');

        // Total pengembalian (status = SELESAI)
        $totalPengembalian = Peminjaman::where('status', 'SELESAI')->count();

        // Total peminjaman (status = DITERIMA)
        $totalPeminjaman = Peminjaman::where('status', 'DITERIMA')->count();
        
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
     
        return view('post_admin/dashboard', compact('peminjamans', 'startNumber', 'peminjamanditerima', 'totalSarana', 'totalPengembalian', 'totalPeminjaman')); 
    }

    public function profiladmin()
    {
        $profiladmin = AdminLog::all();
        return view('post_admin.profil_admin', compact('profiladmin'));
       
    }

    public function profileadminupdate(Request $request)
    {
        $user = AdminLog::find(Auth::id());
        $user->update($request->all());
        if ($user) {
            Session::flash('edit', 'success');
            Session::flash('textedit', 'Ubah Data Profil Berhasil');
        }
        return redirect()->route('profiladmin');
    }
}
