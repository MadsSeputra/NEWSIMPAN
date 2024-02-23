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
          <li class="breadcrumb-item active">Transaksi Peminjaman</li>
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
                <h5 class="card-title" style="padding-bottom: 2rem;">Data Transaksi Peminjaman</h5> 

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
          <th>Aksi</th>
          
        </tr>
      </thead>

<!-- letak koneksi database pake foreach( $... as $...) -->

      @foreach($peminjamans as $key=>$peminjaman) <!-- Untuk menampilkan database sesuai dengan variabel di controller--> 

      <tbody>
        <tr>
          <td>{{ $startNumber + $key }}</td>
          <td>TR-{{ now()->year }}{{ str_pad(now()->month, 2, '0', STR_PAD_LEFT) }}{{ $peminjaman->id }}</td>
          <td>{{ $peminjaman->userLog->nama }}</td>
          <td>{{ $peminjaman->userLog->no_telp }}</td>
          <td>{{ $peminjaman->dbsarana->nama_sarana }}</td>
          <td>{{ $peminjaman->dbsarana->jumlah_sarana }}</td>
          <td>{{ $peminjaman->tanggal_pinjam }}</td>
          <td>{{ $peminjaman->tanggal_kembali }}</td>
          <td>{{ $peminjaman->keterangan }}</td>
          <td>{{ $peminjaman->status }}</td>
          <td class="d-flex align-items-center">
            <a href="{{ route('editdatasarana', ['id' => $peminjaman->id]) }}" class="btn btn-success" style="margin-right: 5px;">
                <i class="bi bi-check-circle"></i>   
            </a> 
            <a href="{{ route('editdatasarana', ['id' => $peminjaman->id]) }}" class="btn btn-danger" style="margin-right: 5px;">
              <i class="bi bi-exclamation-octagon"></i>   
          </a> 
          </td>
        </tr>
        
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@section('content') 


    <!-- Start Table --> 
    <section class="section">
        <div class="row">
          <div class="col-lg-12">
  
            <div class="card">
              <div class="card-body">
                <h5 class="card-title" style="padding-bottom: 2rem;">Data Transaksi Peminjaman terkonfirmasi</h5>

                @php
                $currentPage = request()->get('page', 1);
                $itemsPerPage = 5; // Jumlah item per halaman (sesuaikan dengan paginate() Anda)
                $startNumber = ($currentPage - 1) * $itemsPerPage + 1;
                @endphp

    <!-- Table with hoverable rows -->
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
          <th scope="col">Action</th>
          
        </tr>
      </thead>

<!-- letak koneksi database pake foreach( $... as $...) -->

      {{-- @foreach($dataterdaftar as $data=>$item) <!-- Untuk menampilkan database sesuai dengan variabel di controller-->  --}}

      <tbody>
        {{-- <tr>
          <td> <p>{{ $startNumber + $loop->index }}</p> </td>
          <td>MR-{{ now()->year }}{{ str_pad(now()->month, 2, '0', STR_PAD_LEFT) }}{{ $item->id }}</td>
          <td>{{ $item->nama }}</td>
          <td>{{ $item->email }}</td>
          <td>{{ $item->no_telp }}</td>
          <td>{{ $item->alamat}}</td>
        </tr>
        @endforeach --}}
      </tbody>
    </table>
    <!-- End Table with hoverable rows -->
  </div>
</div>


