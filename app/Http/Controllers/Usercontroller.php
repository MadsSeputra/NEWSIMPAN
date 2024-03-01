<?php

namespace App\Http\Controllers;

use App\Models\UserLog;
use Illuminate\Http\Request;

class Usercontroller extends Controller
{
    public function profiluser()
    {
        $profiluser = UserLog::all();
        return view('post_admin.profil_user', compact('profiluser'));
       
    }
}
