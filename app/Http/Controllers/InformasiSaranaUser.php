<?php

namespace App\Http\Controllers;

use App\Models\Dbsarana;

use Illuminate\Http\Request;

class InformasiSaranaUser extends Controller
{
    public function informasisaranauser()
    {
        $tampildatasarana = Dbsarana::where('status', 'AKTIF')->get(); // Menampilkan data sarana yang aktif saja
        return view('post_admin.informasi_sarana_user', compact('tampildatasarana'));

    }
}
