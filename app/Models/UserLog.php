<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
//use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Auth\Passwords\CanResetPassword;


class UserLog extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, CanResetPassword;
    public $timestamps = false;
    protected $table ="user_logs";
    protected $primaryKey = "id";
    protected $fillable =[
        'nama',
        'email',
        'password',
        'alamat',
        'no_telp',
    ];
    


    protected $hidden = [
        'password',
        'remember_token',
    ];



    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    
}
