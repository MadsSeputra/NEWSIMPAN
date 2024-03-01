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
                <h5 class="card-title" style="padding-bottom: 2rem;">Data Transaksi Pengembalian</h5>

                  <!-- Button pengajuan peminjaman --> 
              <a href={{ route('tambahpengajuan') }}><button type="button" class="btn btn-secondary">Pengajuan Peminjaman</button></a> 
              <!-- End Button pengajuan peminjaman --

                {{-- @php
                $currentPage = request()->get('page', 1);
                $itemsPerPage = 5; // Jumlah item per halaman (sesuaikan dengan paginate() Anda)
                $startNumber = ($currentPage - 1) * $itemsPerPage + 1;
                @endphp --}}

    <!-- Table with hoverable rows -->
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Id Transaksi</th>
          <th scope="col">Sarana </th>
          <th scope="col">Jumlah</th>
          <th scope="col">Tanggal Pinjam</th>
          <th scope="col">Tanggal Kembali</th>
          <th scope="col">Ket.</th>
          <th scope="col">Status</th>
          
          
        </tr>
      </thead>

<!-- letak koneksi database pake foreach( $... as $...) -->

      @foreach($peminjamans as $key=>$peminjaman) <!-- Untuk menampilkan database sesuai dengan variabel di controller--> 

      <tbody>
        <tr>
          <td>{{ $startNumber + $key }}</td>
          <td>TR-{{ now()->year }}{{ str_pad(now()->month, 2, '0', STR_PAD_LEFT) }}{{ $peminjaman->id }}</td>
          <td>{{ $peminjaman->dbsarana->nama_sarana }}</td>
          <td>{{ $peminjaman->jumlah }}</td>
          <td>{{ $peminjaman->tanggal_pinjam }}</td>
          <td>{{ $peminjaman->tanggal_kembali }}</td>
          <td>{{ $peminjaman->keterangan }}</td>
          <td>{{ $peminjaman->status }}</td>
        </tr>
        
        @endforeach
      </tbody>
    </table>
   
  </div>
</div>
@section('content') 