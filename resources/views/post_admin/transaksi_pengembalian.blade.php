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
@if(Session::has('selesai'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('selesai') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
  </button>
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
                             <form action="{{ route('selesaipeminjaman', $pengembalian->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                  Selesai
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Pengembalian</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        <!-- Isi konten modal di sini -->
                                        Yakin Ingin Menyelesaikan Pengembalian Sarana
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Selesai</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </form>
                          </td>
                      </tr>
                  </tbody>
                  @endforeach       
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
@section('content')