@extends('layouts.app_admin')
@section('action')
@section('title', 'Laporan Peminjaman')
{{-- @section('navbar', 'Pengemudi')
@section('data', 'Dashboard') --}}
@endsection
@section('content')
<!-- Start Page Title -->
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Laporan Peminjaman</h1>
      <br>
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
          <h5 class="card-title" style="padding-bottom: 2rem;">Laporan Peminjaman</h5> 
            <div class="container mb-2">
              <form id="filterForm">
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
                    <div class="col-md-2 col-sm-6">
                        <label for="status" class="form-label">Status:</label>
                        <select name="status" id="status" class="form-select">
                            <option value="DITERIMA">DITERIMA</option>
                            <option value="DIBATALKAN">DIBATALKAN</option>
                        </select>
                    </div>
                    <div class="col-md-2 col-sm-12 mt-4">
                        <button class="btn btn-primary mt-md-2" type="submit">Cetak</button>
                    </div>
                </div>
              </form>
        </div>
            <div class="table-responsive">
              <table class="table datatable table-hover">
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
                  <tbody>
                    @foreach($batal as $key => $batal)
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
                          <td>
                            @if($batal->status == 'DITERIMA')
                                <span class="badge bg-warning">{{ $batal->status }}</span>
                            @elseif($batal->status == 'DIBATALKAN')
                                <span class="badge bg-danger">{{ $batal->status }}</span>
                            @else
                                <span class="badge bg-primary">{{ $batal->status }}</span>
                            @endif
                        </td>
                      </tr>
                      @endforeach   
                  </tbody>           
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Tambahkan script JavaScript -->
<script>
  // Tangkap elemen form
  const filterForm = document.getElementById('filterForm');

  // Tangkap elemen select bulan, tahun, dan status
  const bulanSelect = document.getElementById('bulan');
  const tahunInput = document.getElementById('tahun');
  const statusSelect = document.getElementById('status');

  // Tambahkan event listener untuk mengirimkan permintaan cetak laporan
  filterForm.addEventListener('submit', function(event) {
      event.preventDefault();

      // Ambil nilai bulan, tahun, dan status yang dipilih
      const bulan = bulanSelect.value;
      const tahun = tahunInput.value;
      const status = statusSelect.value;

      // Kirim permintaan cetak laporan dengan parameter bulan, tahun, dan status
      window.location.href = '{{ route('lihatpeminjaman', ['tahun' => 'tahun_value', 'bulan' => 'bulan_value', 'status' => 'status_value']) }}'
          .replace('tahun_value', tahun)
          .replace('bulan_value', bulan)
          .replace('status_value', status);
  });
</script>
@endsection
