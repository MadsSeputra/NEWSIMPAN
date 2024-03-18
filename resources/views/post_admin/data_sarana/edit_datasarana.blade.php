@extends('layouts.app_admin')
@section('action')
@section('title', 'Edit Data Sarana')
{{-- @section('navbar', 'Pengemudi')
@section('data', 'Dashboard') --}}
@endsection
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Edit Data Sarana</h1>
      <br>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Edit data sarana</h5>
              <!-- Vertical Form -->
              <form class="row g-3" action="{{ route('updatedatasarana', $datasarana->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-12">
                  <label for="inputNanme4" class="form-label">Nama Sarana</label>
                  <input type="text" name="nama_sarana" class="form-control" id="nama_sarana" value="{{ $datasarana->nama_sarana }}">
                </div>
                <div class="col-12">
                    <label for="jumlah_sarana" class="form-label">Jumlah Sarana</label>
                    <input type="number" name="jumlah_sarana" class="form-control" id="jumlah_sarana" value="{{ $datasarana->jumlah_sarana }}">
                </div>
                 <!-- Sarana (pilihan dengan dropdown select) -->
                 <div class="form-group">
                  <label for="status">Status</label>
                  <select class="form-select" name="status" id="status" >
                      <option value="" selected disabled>Ubah Status</option>
                      <!-- Tambahkan opsi untuk Aktif -->
                      <option value="AKTIF">AKTIF</option>
                      <!-- Tambahkan opsi untuk Non Aktif -->
                      <option value="NON-AKTIF">NON-AKTIF</option>
                  </select>
                </div>
                <div class="col-12">
                  <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                  <div class="col-sm-10">
                      <div class="upload__box">
                          @error('images[]')
                              <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                          @enderror
                          <div class="upload__btn-box">
                              <label class="upload__btn btn btn">
                                  {{-- <p>Choose An Image</p> --}}
                                  <input type="file" name="image" accept="image/*" multiple data-max_length="20" class="upload__inputfile">
                              </label>
                          </div>
                          <div class="upload__img-wrap">
                              @if($datasarana->images)
                                  @if ($datasarana->images instanceof App\Models\Image)
                                      <div class='upload__img-box'>
                                          <div style='background-image: url({{ asset('storage/' . $datasarana->images->src) }})' data-number='{{ $datasarana }}' data-id="{{ $datasarana->images->id }}" data-file='{{ 'storage/' . $datasarana->images->src }}' class='img-bg'>
                                              <div class='upload__img-close'></div>
                                          </div>
                                      </div>
                                  @endif
                              @endif
                          </div>                        
                      </div>
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
@endsection
