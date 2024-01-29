<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransaksiUser extends Controller
{
    public function transaksiuser()
    {
        return view('post_admin/transaksi_user');
    }
}
