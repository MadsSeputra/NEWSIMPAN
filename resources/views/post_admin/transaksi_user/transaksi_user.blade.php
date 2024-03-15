@extends('layouts.app_admin')
@section('action')
@section('title', 'Transaksi User')
@endsection

@section('content')
<!-- Start Page Title -->
<main id="main" class="main">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="pagetitle">
                    <h1>Transaksi User</h1>
                    <br>
                </div>
                <!-- End Page Title -->

                <!-- start JS untuk Validasi -->
                <!-- JS Validasi  -->

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
                        <h5 class="card-title" style="padding-bottom: 2rem;">Data Transaksi User</h5>

                        <!-- Button pengajuan peminjaman -->
                        <a href={{ route('tambahpengajuan') }}><button type="button" class="btn btn-secondary mb-2">Pengajuan Peminjaman</button></a>

                        <!-- Table with hoverable rows -->
                        <div class="table-responsive">
                            <table class="table datatable table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Id Transaksi</th>
                                        <th scope="col">Sarana</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Tanggal Pinjam</th>
                                        <th scope="col">Tanggal Kembali</th>
                                        <th scope="col">Ket.</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($peminjamans as $key=>$peminjaman)
                                    <tr>
                                        <td>{{ $startNumber + $key }}</td>
                                        <td>TR-{{ now()->year }}{{ str_pad(now()->month, 2, '0', STR_PAD_LEFT) }}{{ $peminjaman->id }}</td>
                                        <td>{{ $peminjaman->dbsarana->nama_sarana }}</td>
                                        <td>{{ $peminjaman->jumlah }}</td>
                                        <td>{{ $peminjaman->tanggal_pinjam }}</td>
                                        <td>{{ $peminjaman->tanggal_kembali }}</td>
                                        <td>{{ $peminjaman->keterangan }}</td>
                                        <td>
                                            @if($peminjaman->status == 'DITERIMA')
                                            <span class="badge bg-success">{{ $peminjaman->status }}</span>
                                            @elseif($peminjaman->status == 'DIBATALKAN')
                                            <span class="badge bg-danger">{{ $peminjaman->status }}</span>
                                            @elseif($peminjaman->status == 'DALAM-PROSES')
                                            <span class="badge bg-warning">{{ $peminjaman->status }}</span>
                                            @else
                                            <span class="badge bg-success">{{ $peminjaman->status }}</span>
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
</main>
@endsection
