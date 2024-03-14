<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjamans';

    protected $fillable = [
        'id_userlog',
        'id_dbsarana',
        'jumlah',
        'tanggal_pinjam',
        'tanggal_kembali',
        'keterangan',
        'status',
    ];
   

    public function userLog()
    {
        return $this->belongsTo(UserLog::class, 'id_userlog', 'id');
    }

    public function dbsarana()
    {
        return $this->belongsTo(Dbsarana::class, 'id_dbsarana', 'id');
    }

    // Mendefinisikan accessor untuk tanggal_kembali_melewati_batas
    public function getTanggalKembaliMelewatiBatasAttribute()
    {
        return strtotime($this->tanggal_kembali) > strtotime($this->tanggal_pinjam);
    }
}
