@extends('layouts.app_admin')
@section('action')
@section('title', 'Dashboard Admin')
{{-- @section('navbar', 'Pengemudi')
@section('data', 'Dashboard') --}}
@endsection
@section('content')
<!-- Start Page Title -->
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Laporan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">Laporan Pengembalian</li>
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
           <!-- Start Table --> 
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title" style="padding-bottom: 2rem;">Data Transaksi Peminjaman Dalam Proses</h5> 
                <div class="container mb-2">
                  <div class="row">
                      <div class="col-md-2 col-sm-6">
                          <label for="bulan" class="form-label">Bulan:</label>
                          <select name="bulan" id="bulan" class="form-select">
                              <option value="1">January</option>
                              <option value="2">February</option>
                              <option value="3">March</option>
                              <option value="4">April</option>
                              <option value="5">May</option>
                              <option value="6">June</option>
                              <option value="7">July</option>
                              <option value="8">August</option>
                              <option value="9">September</option>
                              <option value="10">October</option>
                              <option value="11">November</option>
                              <option value="12">December</option>
                          </select>
                      </div>
                      <div class="col-md-2 col-sm-6">
                          <label for="tahun" class="form-label">Tahun:</label>
                          <input type="text" name="tahun" id="tahun" required pattern="[0-9]{4}" placeholder="(contoh: 2022)" class="form-control">
                      </div>
                      <div class="col-md-2 col-sm-12 mt-4">
                          <button class="btn btn-primary mt-md-2" type="submit">Cetak Data</button>
                      </div>
                  </div>
              </div>
              <div class="table-responsive">
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
                      
                    </tr>
                  </thead>

                    <!-- letak koneksi database pake foreach( $... as $...) -->

                    @foreach($batal as $key => $batal)
                    <tbody>
                        <tr>
                            <td>{{ $startNumber + $key }}</td>
                            <td>TR-{{ now()->year }}{{ str_pad(now()->month, 2, '0', STR_PAD_LEFT) }}{{ $batal->id }}</td>
                            <td>{{ $batal->userLog->nama }}</td>
                            <td>{{ $batal->userLog->no_telp }}</td>
                            <td>{{ $batal->dbsarana->nama_sarana }}</td>
                            <td>{{ $batal->jumlah }}</td>
                            <td>{{ $batal->tanggal_pinjam }}</td>
                            <td>{{ $batal->tanggal_kembali }}</td>
                            <td>{{ $batal->keterangan }}</td>
                            <td>{{ $batal->status }}</td>
                        </tr>
                    </tbody>
                    @endforeach              
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

@endsection
