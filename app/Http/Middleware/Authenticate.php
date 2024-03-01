<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
// use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    //tempat mengecek apakah pengguna telah login -- jika belum di tendang ke named route login
    protected function redirectTo($request)
    {
        if(! $request->expectsJson()){
            return route('login');
        }
    }
}
