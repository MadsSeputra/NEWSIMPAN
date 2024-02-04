<?php

namespace App\Http\Controllers;

//import model dbsarana
use App\Models\Dbsarana;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class MasterDataController extends Controller
{
    //controller untuk menu data sarana
    public function datasarana()
    {
        // get dbsarana
        //variabel penyimpan data = Memanggil model Dbsarana::methode latest (urut data berdasar tebaru)()-> paginate (5) membatasi agar menampilkan 5 data v vg
        //$dbsarana = Dbsarana::latest()->paginate(5);

        $datasarana = Dbsarana::all();
        return view('post_admin.data_sarana.data_sarana', compact('datasarana'));
        

        //render view with Dbsarana , fungsi comppact adalah mengirimkan variabel $dbsarana ke view 
        //return view('post_admin/data_sarana', compact('dbsarana'));
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
            Session::flash('message', 'Tambah Data Sarana Berhasil');
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
       $datasarana = Dbsarana::findOrfail($id);
       $datasarana->update($request->all());
       if ($datasarana) {
        Session::flash('edit', 'Ubah Data Sarana Berhasil');
        }
        return redirect()->route('datasarana');
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

    // function data bernama datapeminjam ||  controlller untuk data peminjam
    public function datapeminjam()
    {
        return view('post_admin/data_peminjam');
    }

}
