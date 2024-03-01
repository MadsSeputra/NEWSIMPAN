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
    @elseif(Session::has('konfirmasi'))
    <div class="alert alert-success" role="alert">
      Konfirmasi Pinjaman Berhasil
    </div>
    @endif
    <!-- End JS Validasi  -->


        <!-- Start Table --> 
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title" style="padding-bottom: 2rem;">Data Transaksi Peminjaman Dalam Proses</h5> 

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
                    
                  </tr>
                </thead>

                  <!-- letak koneksi database pake foreach( $... as $...) -->

                  @foreach($peminjamans as $key => $peminjaman)
                  <tbody>
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
                          <td>{{ $peminjaman->status }}</td>
                          <td class="d-flex align-items-center mt-4">
                            <form action="{{ route('konfirmasipeminjaman', $peminjaman->id) }}" method="POST">
                              @csrf
                              <div class="form-group d-none">
                                  <label for="status">Konfirmasi Pemesanan</label>
                                  <select class="form-control" id="status" name="status">
                                      <option value="DITERIMA">DITERIMA</option>
                                  </select>
                              </div>
                              <button type="submit" class="btn btn-success" style="margin-right: 5px;">
                                  <i class="bi bi-check-circle"></i>
                              </button>
                          </form>
                              <form action="{{ route('data.delete', $peminjaman->id) }}" method="POST">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-danger">
                                      <i class="bi bi-exclamation-octagon"></i>
                                  </button>
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
                    {{-- <th scope="col">Aksi</th> --}}
                  </tr>
                </thead>
          
                <!-- letak koneksi database pake foreach( $... as $...) -->
          
                {{-- @foreach($dataterdaftar as $data=>$item) <!-- Untuk menampilkan database sesuai dengan variabel di controller-->  --}}
          
                <tbody>
                  @foreach($peminjamanditerima as $key => $peminjamanditerima)
                  <tbody>
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
                          <td>{{ $peminjamanditerima->status }}</td>
                          {{-- <td class="d-flex align-items-center mt-4">
                              <a href="{{ route('editdatasarana', ['id' => $peminjaman->id]) }}" class="btn btn-success mb-3" style="margin-right: 5px;">
                                  <i class="bi bi-check-circle"></i>
                              </a> 
                              <form action="{{ route('data.delete', $peminjaman->id) }}" method="POST">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-danger">
                                      <i class="bi bi-exclamation-octagon"></i>
                                  </button>
                              </form>
                          </td> --}}
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
</main>

 

@section('content') 
