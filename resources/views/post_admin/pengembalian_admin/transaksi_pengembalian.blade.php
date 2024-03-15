@extends('layouts.app_admin')
@section('action')
@section('title', 'Transaksi Pengembalian')
@endsection

@section('content')
<!-- Start Page Title -->
<main id="main" class="main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="pagetitle">
                    <h1>Transaksi Pengembalian</h1>
                    <br>
                </div>
                <!-- End Page Title -->

                <!-- start JS untuk Validasi -->
                @if(Session::has('selesai'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('selesai') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <!-- End JS Validasi  -->

                <section class="section">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title" style="padding-bottom: 2rem;">Proses Pengembalian</h5>

                                    <div class="table-responsive">
                                        <table class="table datatable table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Id Transaksi</th>
                                                    <th scope="col">Nama Peminjam</th>
                                                    <th scope="col">No Telp</th>
                                                    <th scope="col">Sarana</th>
                                                    <th scope="col">Jumlah</th>
                                                    <th scope="col">Tanggal Pinjam</th>
                                                    <th scope="col">Tanggal Kembali</th>
                                                    <th scope="col">Ket.</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($pengembalian as $key => $pengembalian)
                                                <tr>
                                                    <td>{{ $startNumber + $key }}</td>
                                                    <td>TR-{{ now()->year }}{{ str_pad(now()->month, 2, '0', STR_PAD_LEFT) }}{{ $pengembalian->id }}</td>
                                                    <td>{{ $pengembalian->userLog->nama }}</td>
                                                    <td>{{ $pengembalian->userLog->no_telp }}</td>
                                                    <td>{{ $pengembalian->dbsarana->nama_sarana }}</td>
                                                    <td>{{ $pengembalian->jumlah }}</td>
                                                    <td>{{ $pengembalian->tanggal_pinjam }}</td>
                                                    <td>{{ $pengembalian->tanggal_kembali }}</td>
                                                    <td>{{ $pengembalian->keterangan }}</td>
                                                    <td><span class="badge bg-success">{{ $pengembalian->status }}</span></td>
                                                    <td class="d-flex align-items-center mt-4">
                                                        <form action="{{ route('selesaipeminjaman', $pengembalian->id) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $pengembalian->id }}">
                                                                Selesai
                                                            </button>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModal-{{ $pengembalian->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Pengembalian</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <!-- Isi konten modal di sini -->
                                                                            Yakin Ingin Menyelesaikan Pengembalian Sarana ID: TR-{{ now()->year }}{{ str_pad(now()->month, 2, '0', STR_PAD_LEFT) }}{{ $pengembalian->id }}
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                            <form action="{{ route('selesaipeminjaman', $pengembalian->id) }}" method="POST">
                                                                                @csrf
                                                                                <button type="submit" class="btn btn-primary">Selesai</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
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
                </section>
            </div>
        </div>
    </div>
</main>
@endsection
