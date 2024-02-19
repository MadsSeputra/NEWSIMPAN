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
          <li class="breadcrumb-item active">Data Sarana</li>
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
              <h5 class="card-title" style="padding-bottom: 1rem;">Data sarana</h5>
              
              <!-- Button tambah dan cetak data  --> 
              <a href={{ route('tambahdatasarana') }}><button type="button" class="btn btn-secondary">Tambah Data</button></a> 
              <a href="#"><button type="button" class="btn btn-secondary" >Cetak Data</button></a> 
              <!-- End Button tambah dan cetak data  --> 

                {{-- Ambil nomor halaman saat ini --}}
                @php
                $currentPage = request()->get('page', 1);
                $itemsPerPage = 5; // Jumlah item per halaman (sesuaikan dengan paginate() Anda)
                $startNumber = ($currentPage - 1) * $itemsPerPage + 1;
                @endphp

              <!-- Table with stripped rows -->
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th> No </th>
                    <th>Id Sarana</th>
                    <th>Nama Sarana</th>
                    <th>Jumlah Sarana</th>
                    <th>Aksi</th>
                  </tr>
                </thead>

                @foreach($datasarana as $data=>$item) <!-- Untuk menampilkan database sesuai dengan variabel di controller--> 
                
                <tbody>  
                  <tr>
                    <td> <p>{{ $startNumber + $loop->index }}</p> </td>
                    <td>Sar-{{ now()->year }}{{ str_pad(now()->month, 2, '0', STR_PAD_LEFT) }}{{ $item->id }}</td>
                    <td>{{ $item->nama_sarana }}</td>
                    <td>{{ $item->jumlah_sarana }}</td>
                    <td class="d-flex align-items-center">
                      <a href="{{ route('editdatasarana', ['id' => $item->id]) }}" class="btn btn-primary mb-3" style="margin-right: 5px;">
                          <i class="bi bi-pencil-square"></i> Edit
                      </a> 
                  
                      <form action="{{ route('data.delete', $item->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger">
                              <i class="bi bi-trash"></i> Hapus
                          </button>
                      </form>
                  </td>
                  
                  
                  </tr>

                  @endforeach

                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
@section('content')