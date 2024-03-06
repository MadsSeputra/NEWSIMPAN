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
              <h5 class="card-title">Tambah Data</h5>
              <!-- Vertical Form -->
              <form class="row g-3" action="{{ route('insert-datasarana') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-12">
                  <label for="inputNanme4" class="form-label">Nama Sarana</label>
                  <input type="text" name="nama_sarana" class="form-control" id="nama_sarana">
                </div>
                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Jumlah Sarana</label>
                    <input type="number" name="jumlah_sarana" class="form-control" id="jumlah_sarana">
                  </div>
                  <div class="col-12">
                    <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="file" name="images[]" multiple data-max_length="20">
                    </div>
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
  @section('content')
