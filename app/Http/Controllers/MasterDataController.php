<?php

namespace App\Http\Controllers;

//import model dbsarana
use Carbon\Carbon;

use Dompdf\Dompdf;
use App\Models\Image;
use App\Models\UserLog;
use App\Models\Dbsarana;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class MasterDataController extends Controller
{
    //controller untuk menu data sarana
    public function datasarana()
    {
        //variabel penyimpan data = Memanggil model Dbsarana::methode latest (urut data berdasar tebaru)()-> paginate (5) membatasi agar menampilkan 5 data v vg
        //$dbsarana = Dbsarana::latest()->paginate(5);

         // Mengambil semua data dari tabel Dbsarana
         $datasarana = Dbsarana::with('images')->get();

        // Mengambil jumlah yang telah dipinjam dari tabel Peminjaman
        $jumlahDipinjam = Peminjaman::count('jumlah');

    return view('post_admin.data_sarana.data_sarana', compact('datasarana', 'jumlahDipinjam'));
        
        //fungsi comppact adalah mengirimkan variabel $dbsarana ke view 

    }
    public function tambahdatasarana()
    {
        // menampilkan view 
        $tambahdatasarana = Dbsarana::all();
        return view('post_admin.data_sarana.tambah_datasarana', compact('tambahdatasarana'));
        
    }
    public function store(Request $request)
    {      
        //input ke database
        $datasarana = Dbsarana::create($request->all());
        if ($datasarana) {
            Session::flash('status', 'success');
            Session::flash('tambah', 'Tambah Data Sarana Berhasil');
            return redirect()->route('datasarana');
        } else {
            return redirect()->back()->withErrors(['Gagal menambahkan data sarana.']);
        }
    }
    public function edit($id)
    {
        
        $datasarana = Dbsarana::findOrFail($id);
        return view('post_admin.data_sarana.edit_datasarana', ['datasarana' => $datasarana]);
    }
    public function update(Request $request, $id)
    {
        $datasarana = Dbsarana::findOrFail($id);

        // Perbarui data Dbsarana dengan input yang diterima
        $datasarana->update($request->all());

        // Cek apakah ada gambar yang diunggah dalam request
        if ($request->hasFile('image')) {
            $saranaimage = Dbsarana::findOrFail($id);
            // Hapus gambar-gambar yang terkait dengan Dbsarana ini
            if ($datasarana->images instanceof Image) {
                // Hapus gambar dari penyimpanan
                Storage::delete($datasarana->images->src);
                // Hapus record gambar dari database
                $datasarana->images->delete();
            }
        


            // Upload dan simpan gambar baru
            $imagePath = $request->file('image')->store('images', 'public');
            $image = Image::create([
                'path' => $imagePath,
                'src' => $imagePath, // Sesuaikan nilai 'src' sesuai dengan 'path'
                'thumb' => $imagePath,
                'alt' => $imagePath,
                'imageable_id' => $datasarana->id, // Berikan nilai 'imageable_id'
                'imageable_type' => 'App\Models\Dbsarana', // Sesuaikan dengan tipe model yang berelasi
            ]);
            // Asosiasikan gambar dengan entitas menggunakan relasi polimorfik
            $datasarana->images()->save($image);
        }
        // Setelah selesai, redirect ke halaman tampilan data sarana
        return redirect()->route('datasarana')->with('edit', 'Ubah Data Sarana Berhasil');
    }




    public function delete($id)
    {
        $delete =  Dbsarana::find($id);

        if (!$delete) {
            return abort(404, 'delete not found');
        }

        $delete->delete();

        return redirect()->route('datasarana')->with('delete', 'Data berhasil dihapus');
    }



    // function data bernama dataterdaftar ||  controlller untuk data terdaftar
    //menampilkan database ke view dat terdaftar
    public function dataterdaftar()
    {
        
        $dataterdaftar = UserLog::all();
        return view('post_admin.data_terdaftar.data_terdaftar', compact('dataterdaftar'));
        
        return view('post_admin.data_terdaftar.data_terdaftar');
    }


    public function lihatcetakdatasarana()
    {

        $datasarana = Dbsarana::with('images')->get();

        // Menghitung nomor urut pada halaman saat ini
        $currentPage = request()->get('page', 1);
        $itemsPerPage = 5;
        $startNumber = ($currentPage - 1) * $itemsPerPage + 1;

        return view('post_admin.data_sarana.cetak_datasarana', compact('datasarana', 'startNumber'));
    }

    public function cetakdatasarana()
    {

        $datasarana = Dbsarana::with('images')->get();

        // Menghitung nomor urut pada halaman saat ini
        $currentPage = request()->get('page', 1);
        $itemsPerPage = 5;
        $startNumber = ($currentPage - 1) * $itemsPerPage + 1;

        // Render view ke dalam HTML
        $html = View::make('post_admin..data_sarana.cetak_datasarana', compact('datasarana','startNumber'))->render();

        // Buat instance Dompdf
        $dompdf = new Dompdf();
        
        // Load HTML ke dalam Dompdf
        $dompdf->loadHtml($html);

        // Atur ukuran dan orientasi halaman
        $dompdf->setPaper('A4', 'potrait');

        // Render HTML ke dalam PDF
        $dompdf->render();

        // Kembalikan file PDF sebagai respons
        return $dompdf->stream('laporan-datasarana.pdf');
    }

}
