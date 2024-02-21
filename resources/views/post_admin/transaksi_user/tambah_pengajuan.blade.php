@extends('layouts.app_admin')
@section('action')
@section('title', 'Dashboard Admin')
{{-- @section('navbar', 'Pengemudi')
@section('data', 'Dashboard') --}}
@endsection

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Form Layouts</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item active">Layouts</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tambah Pengajuan Peminjaman</h5>

            <!-- Vertical Form -->
            <form class="row g-3" action="{{ route('insert-pengajuan') }}" method="POST" enctype="multipart/form-data">
                @csrf

                  <!-- Nama Peminjam (otomatis sesuai akun yang login) -->
                  <div class="form-group">
                    <label for="nama_peminjam">Nama Peminjam</label>
                    <input type="text" name="nama_peminjam" class="form-control" value="{{ Auth::user()->nama }}" readonly>
                </div>

              <!-- No Telp -->
                            <div class="form-group">
                                <label for="no_telp">No Telp</label>
                                <input type="text" name="no_telp" class="form-control" value="{{ Auth::user()->no_telp }}" readonly>
                            </div>

                            <!-- Sarana (pilihan dengan button memilih) -->
                            <div class="form-group">
                                <label for="id_dbsarana">Sarana</label>
                                <div>
                                    @foreach($dbsaranas as $dbsarana)
                                        <button type="button" class="btn btn-primary btn-sarana" data-id="{{ $dbsarana->id }}" data-jumlah="{{ $dbsarana->jumlah_sarana }}">
                                            {{ $dbsarana->nama_sarana }}
                                        </button>
                                    @endforeach
                                    <input type="hidden" name="id_dbsarana" id="selected-sarana" value="">
                                </div>
                            </div>

                            <!-- Jumlah Sarana (otomatis sesuai dengan sarana yang dipilih) -->
                            <div class="form-group">
                                <label for="jumlah_sarana">Jumlah Sarana</label>
                                <input type="number" name="jumlah_sarana" class="form-control" id="jumlah-sarana" >
                            </div>

                            <!-- Tanggal Pinjam -->
                            <div class="form-group">
                                <label for="tanggal_pinjam">Tanggal Pinjam</label>
                                <input type="date" name="tanggal_pinjam" class="form-control" required>
                            </div>

                            <!-- Tanggal Kembali -->
                            <div class="form-group">
                                <label for="tanggal_kembali">Tanggal Kembali</label>
                                <input type="date" name="tanggal_kembali" class="form-control" required>
                            </div>

                            <!-- Keterangan -->
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea name="keterangan" class="form-control" rows="3" required></textarea>
                            </div>

                            <!-- Status (otomatis belum terkonfirmasi) -->
                            <div class="form-group">
                                <label for="status">Status</label>
                                <input type="text" name="status" class="form-control" value="Belum Terkonfirmasi" readonly>
                            </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div> 
              </form><!-- Vertical Form --> 

            </div>
          </div>
      </div>
    </section>

  </main><!-- End #main -->