<?php

namespace App\Http\Controllers;

use App\Models\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    //
    public function login()
    {
        return view('login');
    }

    public function proseslogin(Request $request)
    {
        //proses memastikan bahwa pengguna telah memasukkan email dan password nya 
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
         //apabila pengguna berhasil login --> maka dilanjut ke proses pemilihan role apakah admin atau user
         // if auth = ppengecekan inputan ke dalam database
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            session()->flash('loginBerhasil', true);
            //return redirect()->intended(route('datasarana'));
            return redirect()->route('dashboard');

        }
        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            session()->flash('loginBerhasil', true);
            //return redirect()->intended(route('informasisaranauser'));
            return redirect()->route('informasisaranauser');
        }
        Session()->flash('status', 'gagal');
        Session()->flash('message', 'login anda gagal');
        return redirect()->route('login');

    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');

    }


    public function register()
    {
        return view('register');

    }

    public function prosesregistrasi(Request $request)
    {
        // $request->validate([
        //     'nama' => 'required',
        //     'no_telp' => 'required|numeric',
        //     'alamat' => 'required',
        //     'email' => 'required|unique:users',
        //     'password' => 'required',
        //     'password_confirm' => 'required|same:password',
        // ]);

        $user = new UserLog([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            
        ]);

        $user->save();
        return redirect()->route('login')->with('registrasiBerhasil', true);
    }

}
