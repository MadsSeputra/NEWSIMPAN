@extends('layouts.app_admin')
@section('action')
@section('title', 'Dashboard Admin')

@endsection

<!-- Start Page Title -->
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Master Data</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">Data Terdaftar</li>
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
                <h5 class="card-title" style="padding-bottom: 2rem;">Data Terdaftar</h5>

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
          <th scope="col">Id Terdaftar</th>
          <th scope="col">Nama Terdaftar </th>
          <th scope="col">E-mail </th>
          <th scope="col">No Telepon</th>
          <th scope="col">Alamat</th>
          
        </tr>
      </thead>

<!-- letak koneksi database pake foreach( $... as $...) -->

      @foreach($dataterdaftar as $data=>$item) <!-- Untuk menampilkan database sesuai dengan variabel di controller--> 

      <tbody>
        <tr>
          <td> <p>{{ $startNumber + $loop->index }}</p> </td>
          <td>MR-{{ now()->year }}{{ str_pad(now()->month, 2, '0', STR_PAD_LEFT) }}{{ $item->id }}</td>
          <td>{{ $item->nama }}</td>
          <td>{{ $item->email }}</td>
          <td>{{ $item->no_telp }}</td>
          <td>{{ $item->alamat}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <!-- End Table with hoverable rows -->

  </div>
</div>