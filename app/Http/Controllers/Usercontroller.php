<?php

namespace App\Http\Controllers;

use App\Models\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Usercontroller extends Controller
{
    public function profiluser()
    {
        $profiluser = UserLog::all();
        return view('post_admin.profil_user', compact('profiluser'));
       
    }

    public function profileuserupdate(Request $request)
    {
        $user = UserLog::find(Auth::id());
        $user->update($request->all());
        if ($user) {
            Session::flash('edit', 'success');
            Session::flash('textedit', 'Ubah Data Profil Berhasil');
        }
        return redirect()->route('profiluser');
    }
    
}