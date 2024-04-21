<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kerusakan extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'kerusakans';
    protected $primaryKey ="id";
    protected $fillable = [
        'id_peminjaman',
        'keterangan',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_peminjaman', 'id');
    }
}
