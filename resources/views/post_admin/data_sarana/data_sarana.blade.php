@extends('layouts.app_admin')
@section('action')
@section('title', 'Data Sarana')
@endsection

@section('content')
<!-- Start Page Title -->
<main id="main" class="main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="pagetitle">
                    <h1>Data Sarana</h1>
                    <br>
                </div>
                <!-- End Page Title -->

                <!-- start JS untuk Validasi -->
                <!-- JS Validasi  -->

                @if(Session::has('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('tambah') }}
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

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title" style="padding-bottom: 1rem;">Data sarana</h5>

                        <!-- Button tambah dan cetak data  -->
                        <a href={{ route('tambahdatasarana') }}><button type="button" class="btn btn-secondary">Tambah Data</button></a> 
                        <a href="{{ route('lihatdatasarana') }}" target="_blank"><button type="button" class="btn btn-secondary" >Cetak Data</button></a> 
                        <!-- End Button tambah dan cetak data  -->

                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table class="table datatable table-hover">
                                <thead>
                                    <tr>
                                        <th> No </th>
                                        <th>Id Sarana</th>
                                        <th>Nama Sarana</th>
                                        <th>Jumlah Sarana</th>
                                        <th>Terpakai</th>
                                        <th>Tersedia</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $startNumber = 1;
                                    @endphp
                                    @foreach($datasarana as $data=>$item) <!-- Untuk menampilkan database sesuai dengan variabel di controller-->
                                    <tr>
                                        <td> <p>{{ $startNumber }}</p> </td>
                                        <td>Sar-{{ now()->year }}{{ str_pad(now()->month, 2, '0', STR_PAD_LEFT) }}{{ $item->id }}</td>
                                        <td>{{ $item->nama_sarana }}</td>
                                        <td>{{ $item->jumlah_sarana }}</td>
                                        <td>{{ $item->jumlah_terpakai }}</td>
                                        <td>{{ (int)$item->jumlah_sarana - (int)$item->jumlah_terpakai }}</td>
                                        <td>
                                            @if($item->images && $item->images->count())
                                            <img class="featured-img img-fluid rounded" src="{{ asset('storage/' . $item->images->src) }}" alt="{{ $item->nama }}" style="width: 100px; height: 100px;">
                                            @else
                                            <img class="featured-img img-fluid rounded" src="{{ asset('assets/img/imagekosong.jpg') }}" alt="{{ $item->nama }}" style="width: 100px; height: 100px;">
                                            @endif
                                        </td>
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
                                    @php
                                    $startNumber++;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </div>
</main>
@endsection
