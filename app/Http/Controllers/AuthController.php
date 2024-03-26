<?php

namespace App\Http\Controllers;

use App\Models\UserLog;
use App\Models\AdminLog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Password;


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
         //apabila pengguna berhasil login --> maka dilanjut ke proses pemilihan role apakah admin atau pengguna
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
        Session()->flash('message', 'Login anda gagal');
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
        //Memasukkan data ke dalam model Userlog
        $user = new UserLog([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            
        ]);
        $user->save(); // Method save data yang telah dimasukkan dalam instance diatas
        return redirect()->route('login')->with('registrasiBerhasil', true);
    }

    public function ubahpassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|current_password',
            'new_password' => 'required',
            'new_password_confirm' => 'required|same:new_password', //Same :new_pass memastikan bahwa field ini harus sama dengan field new_password
        ], [
            'old_password.required' => 'Password lama harus diisi !',
            'new_password.required' => 'Password baru harus diisi !',
            'new_password_confirm.required' => 'Konfirmasi Password harus diisi !',
            'new_password_confirm.same' => 'Konfirmasi Password harus sama dengan Password baru !',
        ]);


        if(Str::length(Auth::guard('web')->user()) > 0){
            $user = UserLog::find(Auth::id()); //memamnggil model userlog disesuaikan dengan id 
            $user->password = Hash::make($request->new_password);
            $user->save();
             // Logout pengguna setelah berhasil update password
            Auth::guard('web')->logout();
            // $request->session()->regenerate();
            return redirect()->route('login')->with('ubahPassword', 'Password Berhasil Diubah'); //kembali diarahkan ke menu login serta pesan flash yang memberi tahu pass diubah

        }elseif(Str::length(Auth::guard('admin')->user()) > 0){
            $admin = AdminLog::find(Auth::id());
            $admin->password = Hash::make($request->new_password);
            $admin->save();
             // Logout pengguna setelah berhasil update password
             Auth::guard('admin')->logout();
            // $request->session()->regenerate();
            return redirect()->route('login')->with('ubahPassword', 'Password Berhasil Diubah');
        }
    }

    public function lupapassword()
    {
        return view('resetpassword');

    }

    public function processLupaPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    
        // Cek apakah email ada pada tabel UserLog
        $user = UserLog::where('email', $request->email)->first();
    
        // Cek apakah email ada pada tabel adminlog jika belum ada di tabel User
        if (!$user) {
            $admin = AdminLog::where('email', $request->email)->first();
        }
    
        // Jika email ada pada tabel User, gunakan metode sendResetLink untuk tabel User
        if ($user) {
            $status = Password::broker('users')->sendResetLink(
                $request->only('email')
            );
        } elseif ($admin) {
            // Jika email ada pada tabel admin, gunakan metode sendResetLink untuk tabel Pengemudi
            $status = Password::broker('admin')->sendResetLink(
                $request->only('email')
            );
        } else {
            // Jika email tidak ada di semua tabel, kembalikan dengan pesan error
            return back()->withErrors(['email' => 'Email tidak ditemukan']);
        }
        
        if ($status) {
            Session::flash('reset', 'Berhasil melakukan reset password, cek email anda untuk melakukan proses selanjutnya');
        }
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetPassword($token) // fungsi token untuk mengidentifikasi permintaan reset pass yang dikirim ke email ||
    {
        return view('reset-password', ['token' => $token]);
    }

    public function processResetPassword(Request $request) //mengirim data yang dikirim melalui form 
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:3|confirmed',
        ]);

        $user = UserLog::where('email', $request->email)->first();
        $admin = AdminLog::where('email', $request->email)->first();

        if ($user) {
            $status = Password::broker('users')->reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->setRememberToken(Str::random(60));

                    $user->save();

                    event(new \Illuminate\Auth\Events\PasswordReset($user));
                }
            );
        } elseif ($admin) {
            $status = Password::broker('admin')->reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($admin, $password) {
                    $admin->forceFill([
                        'password' => Hash::make($password)
                    ])->setRememberToken(Str::random(60));

                    $admin->save();
                    event(new \Illuminate\Auth\Events\PasswordReset($admin));
                }
            );
        } else {
            // Jika email tidak ditemukan dalam ketiga tabel, tampilkan pesan error
            return back()->withErrors(['email' => 'Email not found']);
        }

        return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
    }
}
