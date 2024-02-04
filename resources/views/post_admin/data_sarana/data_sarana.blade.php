@extends('layouts.app_admin')
@section('action')
@section('title', 'Dashboard Admin')
{{-- @section('navbar', 'Pengemudi')
@section('data', 'Dashboard') --}}
@endsection
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
    </div><!-- End Page Title -->


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

    
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data sarana</h5>
              
              <a href={{ route('tambahdatasarana') }}><button type="button" class="btn btn-secondary">Tambah Data</button></a> 
              <a href="#"><button type="button" class="btn btn-secondary">Cetak Data</button></a> 

              <!-- Table with stripped rows -->
              <table class="table">
                <thead>
                  <tr>
                    <th>
                      <b>Id Sarana</b>
                    </th>
                    <th>Nama Sarana</th>
                    <th>Jumlah Sarana</th>

                    <th>Aksi</th>

                   
                  </tr>
                </thead>

                @foreach($datasarana as $data=>$item)
                
                <tbody>
                  <tr>
                    <td>Sar-{{ now()->year }}{{ str_pad(now()->month, 2, '0', STR_PAD_LEFT) }}{{ $item->id }}</td>
                    <td>{{ $item->nama_sarana }}</td>
                    <td>{{ $item->jumlah_sarana }}</td>
                    <td>
                        <a href={{ route('editdatasarana', ['id' => $item->id]) }}><button type="button" class="btn btn-primary">Edit</button> </a> 
                        <form action="{{ route('data.delete', $item->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger">Hapus</button>
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