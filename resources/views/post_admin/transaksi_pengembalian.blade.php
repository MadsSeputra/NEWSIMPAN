@extends('layouts.app_admin')
@section('action')
@section('title', 'Dashboard Admin')
{{-- @section('navbar', 'Pengemudi')
@section('data', 'Dashboard') --}}
@endsection

<!-- Start Page Title -->
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Master Data</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">Transaksi Pengembalian</li>
        </ol>
      </nav>
    </div> 
<!-- End Page Title -->

<!-- start JS untuk Validasi -->
@if(Session::has('status'))
<div class="alert alert-success" role="alert">
  This is a success alert—check it out!
</div>
@elseif(Session::has('delete'))
<div class="alert alert-success" role="alert">
  Data Berhasil Dihapus
</div>
@elseif(Session::has('edit'))
<div class="alert alert-success" role="alert">
  Data Berhasil Diedit
</div>
@endif
<!-- End JS Validasi  -->


    <!-- Start Table --> 
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title" style="padding-bottom: 2rem;">Data Transaksi Peminjaman Diterima</h5> 

              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Id Transaksi</th>
                    <th scope="col">Nama Peminjam </th>
                    <th scope="col">No Telp </th>
                    <th scope="col">Sarana </th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Tanggal Pinjam</th>
                    <th scope="col">Tanggal Kembali</th>
                    <th scope="col">Ket.</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                    {{-- <th scope="col">Aksi</th> --}}
                  </tr>
                </thead>
          
                <!-- letak koneksi database pake foreach( $... as $...) -->
          
                {{-- @foreach($dataterdaftar as $data=>$item) <!-- Untuk menampilkan database sesuai dengan variabel di controller-->  --}}
          
                <tbody>
                  @foreach($pengembalian as $key => $pengembalian)
                  <tbody>
                      <tr>
                          <td>{{ $startNumber + $key }}</td>
                          <td>TR-{{ now()->year }}{{ str_pad(now()->month, 2, '0', STR_PAD_LEFT) }}{{ $pengembalian->id }}</td>
                          <td>{{ $pengembalian->userLog->nama }}</td>
                          <td>{{ $pengembalian->userLog->no_telp }}</td>
                          <td>{{ $pengembalian->dbsarana->nama_sarana }}</td>
                          <td>{{ $pengembalian->jumlah }}</td>
                          <td>{{ $pengembalian->tanggal_pinjam }}</td>
                          <td>{{ $pengembalian->tanggal_kembali }}</td>
                          <td>{{ $pengembalian->keterangan }}</td>
                          <td>{{ $pengembalian->status }}</td>
                          <td class="d-flex align-items-center mt-4">
                             <form action="{{ route('batalpeminjaman', $pengembalian->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-danger">
                                 Selesai
                                </button>
                              </form>
                          </td>
                      </tr>
                  </tbody>
                  @endforeach       
                </tbody>
              </table>
              <!-- Vertically centered modal -->
              <!-- Tombol untuk membuka modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  Buka Modal
</button>

<!-- Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
    
      <!-- Bagian Header Modal -->
      <div class="modal-header">
        <h4 class="modal-title">Judul Modal</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Bagian Body Modal -->
      <div class="modal-body">
        <p>Isi modal di sini...</p>
      </div>
      
      <!-- Bagian Footer Modal -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary">Simpan</button>
      </div>
      
    </div>
  </div>
</div>

            </div>
          </div>
        </div>
      </div>
    </section>
@section('content')