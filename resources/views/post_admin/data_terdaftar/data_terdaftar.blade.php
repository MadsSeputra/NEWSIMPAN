@extends('layouts.app_admin')
@section('action')
@section('title', 'Data Pengguna')
@endsection

@section('content')
<!-- Start Page Title -->
<main id="main" class="main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="pagetitle">
                    <h1>Data Pengguna</h1>
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

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title" style="padding-bottom: 2rem;">Data Pengguna</h5>

                        @php
                        $currentPage = request()->get('page', 1);
                        $itemsPerPage = 5; // Jumlah item per halaman (sesuaikan dengan paginate() Anda)
                        $startNumber = ($currentPage - 1) * $itemsPerPage + 1;
                        @endphp

                        <!-- Table with hoverable rows -->
                        <div class="table-responsive">
                            <table class="table datatable table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Id Terdaftar</th>
                                        <th scope="col">Nama Terdaftar</th>
                                        <th scope="col">E-mail</th>
                                        <th scope="col">No Telepon</th>
                                        <th scope="col">Alamat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dataterdaftar as $data=>$item) <!-- Untuk menampilkan database sesuai dengan variabel di controller-->
                                    <tr>
                                        <td><p>{{ $startNumber + $loop->index }}</p></td>
                                        <td>MR-{{ now()->year }}{{ str_pad(now()->month, 2, '0', STR_PAD_LEFT) }}{{ $item->id }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->no_telp }}</td>
                                        <td>{{ $item->alamat}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table with hoverable rows -->

                    </div>
                </div>

            </div>
        </div>
    </div>
</main>
@endsection
