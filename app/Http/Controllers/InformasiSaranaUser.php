<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformasiSaranaUser extends Controller
{
    public function informasisaranauser()
    {
        return view('post_admin/informasi_sarana_user');
    }
}
