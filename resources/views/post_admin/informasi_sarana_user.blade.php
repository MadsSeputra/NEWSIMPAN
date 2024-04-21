@extends('layouts.app_admin')
@section('action')
@section('title', 'Informasi Sarana User')
@endsection



<!-- Start Page Title -->
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Informasi Sarana</h1>
      <br>
    </div> 
<!-- End Page Title -->


        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Informasi Sarana Upacara</h5>
            <p>Menyajikan informasi terkait ketersediaan sarana upacara yang ada di Banjar Mertha Rauh</p>

            {{-- Ambil nomor halaman saat ini --}}
            @php
            $currentPage = request()->get('page', 1);
            $itemsPerPage = 5; // Jumlah item per halaman (sesuaikan dengan paginate() Anda)
            $startNumber = ($currentPage - 1) * $itemsPerPage + 1;
            @endphp
    
        <div class="table-responsive">
            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                    <th> No </th>
                    <th>Id Sarana</th>
                    <th>Nama Sarana</th>
                    <th>Sarana Tersedia</th>
                    <th>Foto</th>
                </tr>

              </thead>
             <tbody>
                @foreach ($tampildatasarana as $item)
                @if ((int)$item->jumlah_sarana - (int)$item->jumlah_terpakai > 0)
                    <tr>
                        <td> <p>{{ $startNumber + $loop->index }}</p> </td>
                        <td>Sar-{{ now()->year }}{{ str_pad(now()->month, 2, '0', STR_PAD_LEFT) }}{{ $item->id }}</td>
                        <td>{{ $item->nama_sarana }}</td>
                        <td>{{ (int)$item->jumlah_sarana - (int)$item->jumlah_terpakai }}</td>
                        <td>
                            @if($item->images && $item->images->count())
                                <img class="featured-img img-fluid rounded" src="{{ asset('storage/' . $item->images->src) }}" alt="{{ $item->nama }}" style="width: 100px; height: 100px;">
                            @else
                                <img class="featured-img img-fluid rounded" src="{{ asset('assets/img/imagekosong.jpg') }}" alt="{{ $item->nama }}" style="width: 100px; height: 100px;">
                            @endif                  
                        </td>
                    </tr>
                @endif
            @endforeach
    
               
              </tbody>
            </table>
            <!-- End Table with stripped rows -->
        </div>


  </div>
</div>
</main>