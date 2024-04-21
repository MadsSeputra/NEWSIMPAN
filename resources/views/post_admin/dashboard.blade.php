@extends('layouts.app_admin')
@section('action')
@section('title', 'Dashboard Admin')
{{-- @section('navbar', 'Pengemudi')
@section('data', 'Dashboard') --}}
@endsection

@section('content')

<main id="main" class="main" > <!-- style="background-color: rgb(16, 179, 255) || Untuk ubah warna backgound || taruh setelah class="main"-->

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <br>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->

          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                  <div class="card-body">
                      <h1 class="card-title">Total Jumlah Sarana </h1>
          
                      <div class="d-flex align-items-center">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                              <i class="bi bi-boxes"></i>
                          </div>
                          <div class="ps-3">
                              <h6>{{ $totalSarana }}</h6>
                          </div>
                      </div>
                  </div>
              </div>
          </div><!-- End Sales Card -->
          
          <!-- Revenue Card -->
          <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">
                  <div class="card-body">
                      <h1 class="card-title ps-2">Total Peminjaman</h1>
          
                      <div class="d-flex align-items-center">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                              <i class="bi bi-arrow-left-right"></i>
                          </div>
                          <div class="ps-3">
                              <h6>{{ $totalPeminjaman }}</h6>
                          </div>
                      </div>
                  </div>
              </div>
          </div><!-- End Revenue Card -->
          
          <!-- Customers Card -->
          <div class="col-xxl-4 col-xl-12">
              <div class="card info-card customers-card">
                  <div class="card-body">
                      <h5 class="card-title">Total Pengembalian</h5>
          
                      <div class="d-flex align-items-center">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-box-arrow-in-left"></i>
                          </div>
                          <div class="ps-3">
                              <h6>{{ $totalPengembalian }}</h6>
                          </div>
                      </div>
                  </div>
              </div>
          </div>          

            </div><!-- End Customers Card -->
                   <!-- Start Table --> 
                             <!-- Data Transaksi Peminjaman Dalam Proses -->
                             <div class="col-lg-12">
                              <div class="card">
                                  <div class="card-body">
                                      <h5 class="card-title" style="padding-bottom: 2rem;">Data Transaksi Peminjaman Dalam Proses</h5> 
                                      <div class="table-responsive">
                                          <table class="table table-hover">
                                              <thead>
                                                  <tr>
                                                      <th scope="col">No</th>
                                                      <th scope="col">Id Transaksi</th>
                                                      <th scope="col">Nama Peminjam</th>
                                                      <th scope="col">No Telp</th>
                                                      <th scope="col">Sarana</th>
                                                      <th scope="col">Jumlah</th>
                                                      <th scope="col">Tanggal Pinjam</th>
                                                      <th scope="col">Tanggal Kembali</th>
                                                      <th scope="col">Ket.</th>
                                                      <th scope="col">Status</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  <!-- Your PHP loop to populate the table rows -->
                                                  @foreach($peminjamans as $key => $peminjaman)
                                                  <tr>
                                                      <td>{{ $startNumber + $key }}</td>
                                                      <td>TR-{{ now()->year }}{{ str_pad(now()->month, 2, '0', STR_PAD_LEFT) }}{{ $peminjaman->id }}</td>
                                                      <td>{{ $peminjaman->userLog->nama }}</td>
                                                      <td>{{ $peminjaman->userLog->no_telp }}</td>
                                                      <td>{{ $peminjaman->dbsarana->nama_sarana }}</td>
                                                      <td>{{ $peminjaman->jumlah }}</td>
                                                      <td>{{ $peminjaman->tanggal_pinjam }}</td>
                                                      <td>{{ $peminjaman->tanggal_kembali }}</td>
                                                      <td>{{ $peminjaman->keterangan }}</td>
                                                      <td><span class="badge bg-warning ">{{ $peminjaman->status }}</span></td>
                                                  </tr>
                                                  @endforeach
                                              </tbody>
                                          </table>
                                      </div>
                                  </div>
                              </div>
                          </div><!-- End Data Transaksi Peminjaman Dalam Proses -->
      
                          <!-- Data Transaksi Peminjaman Diterima -->
                          <div class="col-lg-12">
                              <div class="card">
                                  <div class="card-body">
                                      <h5 class="card-title" style="padding-bottom: 2rem;">Data Transaksi Peminjaman Diterima</h5> 
                                      <div class="table-responsive">
                                          <table class="table table-hover">
                                              <thead>
                                                  <tr>
                                                      <th scope="col">No</th>
                                                      <th scope="col">Id Transaksi</th>
                                                      <th scope="col">Nama Peminjam</th>
                                                      <th scope="col">No Telp</th>
                                                      <th scope="col">Sarana</th>
                                                      <th scope="col">Jumlah</th>
                                                      <th scope="col">Tanggal Pinjam</th>
                                                      <th scope="col">Tanggal Kembali</th>
                                                      <th scope="col">Ket.</th>
                                                      <th scope="col">Status</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  <!-- Your PHP loop to populate the table rows -->
                                                  @foreach($peminjamanditerima as $key => $peminjamanditerima)
                                                  <tr>
                                                      <td>{{ $startNumber + $key }}</td>
                                                      <td>TR-{{ now()->year }}{{ str_pad(now()->month, 2, '0', STR_PAD_LEFT) }}{{ $peminjamanditerima->id }}</td>
                                                      <td>{{ $peminjamanditerima->userLog->nama }}</td>
                                                      <td>{{ $peminjamanditerima->userLog->no_telp }}</td>
                                                      <td>{{ $peminjamanditerima->dbsarana->nama_sarana }}</td>
                                                      <td>{{ $peminjamanditerima->jumlah }}</td>
                                                      <td>{{ $peminjamanditerima->tanggal_pinjam }}</td>
                                                      <td>{{ $peminjamanditerima->tanggal_kembali }}</td>
                                                      <td>{{ $peminjamanditerima->keterangan }}</td>
                                                      <td><span class="badge bg-success">{{ $peminjamanditerima->status }}</span></td>
                                                  </tr>
                                                  @endforeach
                                              </tbody>
                                          </table>
                                      </div>
                                  </div>
                              </div>
                          </div><!-- End Data Transaksi Peminjaman Diterima -->
                      </div>
                  </div>
              </div>
          </section>
      </div><!-- End container -->
    </section>

</main><!-- End #main -->
  @endsection