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
          <li class="breadcrumb-item active">Data Peminjam</li>
        </ol>
      </nav>
    </div> 
<!-- End Page Title -->


        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Informasi Saran Upacara</h5>
            <p>Menyajikan informasi terkait ketersediaan sarana upacara yang ada di Banjar Mertha Rauh</p>

            {{-- Ambil nomor halaman saat ini --}}
            @php
            $currentPage = request()->get('page', 1);
            $itemsPerPage = 5; // Jumlah item per halaman (sesuaikan dengan paginate() Anda)
            $startNumber = ($currentPage - 1) * $itemsPerPage + 1;
            @endphp

            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                    <th> No </th>
                    <th>Id Sarana</th>
                    <th>Nama Sarana</th>
                    <th>Jumlah Sarana</th>
                </tr>

              </thead>
              <tbody>
                @foreach ($tampildatasarana as $item)
                    <tr>
                        <td> <p>{{ $startNumber + $loop->index }}</p> </td>
                        <td>Sar-{{ now()->year }}{{ str_pad(now()->month, 2, '0', STR_PAD_LEFT) }}{{ $item->id }}</td>
                        <td>{{ $item->nama_sarana }}</td>
                        <td>{{ $item->jumlah_sarana }}</td>
                    </tr>
                    
                @endforeach
    
               
              </tbody>
            </table>
            <!-- End Table with stripped rows -->


  </div>
</div>