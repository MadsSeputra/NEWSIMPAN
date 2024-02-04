<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dbsarana extends Model
{
    use HasFactory;
    /*Step 2 setelah mengisi database/ migrations --> Konfigurasi (mass assignment) propoerti models agar mengizinkan 
    field manipulasi data ke dalam db*/ 
    protected $table = "dbsaranas";
    protected $primaryKey = "id";
    protected $fillable =[
        'nama_sarana',
        'jumlah_sarana'
    ];
}
