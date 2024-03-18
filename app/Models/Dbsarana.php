<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dbsarana extends Model
{
    use HasFactory;
    /*Step 2 setelah mengisi database/ migrations --> Konfigurasi (mass assignment) propoerti models agar mengizinkan 
    field manipulasi data ke dalam db*/ 
    protected $table = "dbsaranas";
    protected $primaryKey ="id";
    protected $fillable =[
        'nama_sarana',
        'jumlah_sarana',
        'jumlah_terpakai',
        'status',
    ];

    //mendefinisikan one to many | karena satu saranan dapat dimiliki oleh banyak pengguna
    // public function UserLog()
    // {
    //     return $this->hasMany(UserLog::class, 'id_sarana','id');
    // }
        //relation
        public function images()
        {
            return $this->morphOne(Image::class, 'imageable');
        }
            // boot
        public static function boot()
        {
            parent::boot();
    
            self::creating(function ($dbsarana) {
                $dbsarana->id = request()->id;
            });
       
            self::created(function ($dbsarana) {
                foreach (request()->file('images') ?? [] as $key => $image) {
                    $uploaded = Image::uploadImage($image);
                    Image::create([
                        'thumb' => 'thumbnails/' . basename($uploaded['thumb']),
                        'src' => 'images/' . basename($uploaded['src']),
                        'alt' => Image::getAlt($image),
                        'imageable_id' => $dbsarana->id,
                        'imageable_type' => "App\Models\Dbsarana"
                    ]);
                }
            });
            
            self::updating(function ($dbsarana) {
                $img_array = explode(',', request()->deleted_images);
                array_pop($img_array);
            
                // Hapus gambar yang dihapus dari penyimpanan lokal
                foreach ($img_array as $key => $image_id) {
                    $will_deleted_image = Image::find($image_id);
                    if (!is_null($will_deleted_image)) {
                        Storage::delete([$will_deleted_image->src, $will_deleted_image->thumb]);
                        $will_deleted_image->delete();
                    }
                }
            
                // Unggah dan simpan gambar baru secara lokal
                foreach (request()->file('images') ?? [] as $key => $image) {
                    $uploaded = Image::uploadImage($image);
                    Image::create([
                        'thumb' => 'thumbnails/' . basename($uploaded['thumb']),
                        'src' => 'images/' . basename($uploaded['src']),
                        'alt' => Image::getAlt($image),
                        'imageable_id' => $dbsarana->id,
                        'imageable_type' => "App\Models\Dbsarana"
                    ]);
                }
            });
            
       
               self::updated(function ($image) {
                    if (!is_null($image->src)) {
                    Storage::delete($image->src);
                }
                if (!is_null($image->thumb)) {
                    Storage::delete($image->thumb);
                }
               });
       
               static::deleting(function ($dbsarana) {
                $dbsarana->images()->delete();
            });

            self::deleted(function ($dbsarana) {
            });
        }

           

}
