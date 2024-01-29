<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterDataController extends Controller
{
    //controller untuk menu data sarana
    public function datasarana()
    {
        return view('post_admin/data_sarana');
    }
    // function data bernama datapeminjam ||  controlller untuk data peminjam
    public function datapeminjam()
    {
        return view('post_admin/data_peminjam');
    }

}
