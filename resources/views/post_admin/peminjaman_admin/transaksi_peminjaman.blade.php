@extends('layouts.app_admin')
@section('action')
@section('title', 'Transaksi Peminjaman')
@endsection

@section('content')
<!-- Start Page Title -->
<main id="main" class="main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="pagetitle">
                    <h1>Transaksi Peminjaman</h1>
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
                    {{ session('edit') }}
                </div>
                @elseif(Session::has('batal'))
                <div class="alert alert-danger" role="alert">
                    {{ session('batal') }}
                </div>
                @endif
                <!-- End JS Validasi  -->

                <!-- Start Table -->
                <section class="section">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title" style="padding-bottom: 2rem;">Data Transaksi Peminjaman Dalam Proses</h5>

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
                                                @foreach($peminjamans as $key => $peminjaman)
                                                <tr>
                                                    <td>{{ $startNumber + $key }}</td>
                                                    <td>TR-{{ now()->year }}{{ str_pad(now()->month, 2, '0', STR_PAD_LEFT) }}{{ $peminjaman->id }}</td>
                                                    <td>{{ $peminjaman->userLog->nama }}</td>
                                                    <td>{{ $peminjaman->userLog->no_telp }}</td>
                                                    <td>{{ $peminjaman->dbsarana->nama_sarana }}</td>
                                                    <td>{{ $peminjaman->jumlah }}</td>
                                                    <td>{{ $peminjaman->tanggal_pinjam }}</td>
                                                    <td>{{ $peminjaman->tanggal_kembali }}</td>
                                                    <td>{{ $peminjaman->keterangan }}</td>
                                                    <td><span class="badge bg-warning ">{{ $peminjaman->status }}</span></td>
                                                    <td class="d-flex align-items-center mt-4">
                                                        <form action="{{ route('konfirmasipeminjaman', $peminjaman->id) }}" method="POST">
                                                            @csrf
                                                            <div class="form-group d-none">
                                                                <label for="status">Konfirmasi Pemesanan</label>
                                                                <select class="form-control" id="status" name="status">
                                                                    <option value="DITERIMA">DITERIMA</option>
                                                                </select>
                                                            </div>
                                                            <div class="flex items-center d-none">
                                                                <input type="email" name="recipient_email" value="{{ $peminjaman->userLog->email }}" placeholder="Alamat Email Penerima" required>
                                                            </div>
                                                            <button type="button" class="btn btn-success" style="margin-right: 5px;" data-bs-toggle="modal" data-bs-target="#konfirmasiModal-{{ $peminjaman->id }}">
                                                                <i class="bi bi-check-circle"></i>
                                                            </button>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="konfirmasiModal-{{ $peminjaman->id }}" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Pinjaman</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <!-- Isi konten modal di sini -->
                                                                            Yakin Ingin Konfirmasi Pinjaman ID: TR-{{ now()->year }}{{ str_pad(now()->month, 2, '0', STR_PAD_LEFT) }}{{ $peminjaman->id }}
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                            <form action="{{ route('konfirmasipeminjaman', $peminjaman->id) }}" method="POST">
                                                                                @csrf
                                                                                <button type="submit" class="btn btn-success">Konfirmasi</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <form action="{{ route('batalpeminjaman', $peminjaman->id) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <div class="flex items-center d-none">
                                                                <input type="email" name="recipient_email" value="{{ $peminjaman->userLog->email }}" placeholder="Alamat Email Penerima" required>
                                                            </div>
                                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#batalModal-{{ $peminjaman->id }}">
                                                                <i class="bi bi-exclamation-octagon"></i>
                                                            </button>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="batalModal-{{ $peminjaman->id }}" tabindex="-1" aria-labelledby="batalModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="batalModalLabel">Pembatalan</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="{{ route('batalpeminjaman', $peminjaman->id) }}" method="POST">
                                                                                @csrf
                                                                                @method('PATCH')
                                                                                <input type="hidden" name="recipient_email" value="{{ $peminjaman->userLog->email }}">
                                                                                <div class="mb-3">
                                                                                    <label for="alasan" class="form-label">Alasan Pembatalan</label>
                                                                                    <textarea class="form-control" id="alasan" name="alasan" rows="3" required></textarea>
                                                                                </div>
                                                                                Yakin Ingin Membatalkan Pinjaman ID: TR-{{ now()->year }}{{ str_pad(now()->month, 2, '0', STR_PAD_LEFT) }}{{ $peminjaman->id }}
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                <button type="submit" class="btn btn-danger">Batalkan</button>
                                                                            </div>
                                                                        </form>
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

                <section class="section">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title" style="padding-bottom: 2rem;">Data Transaksi Peminjaman Diterima</h5>

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
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($peminjamanditerima as $key => $peminjamanditerima)
                                                <tr>
                                                    <td>{{ $startNumber + $key }}</td>
                                                    <td>TR-{{ now()->year }}{{ str_pad(now()->month, 2, '0', STR_PAD_LEFT) }}{{ $peminjamanditerima->id }}</td>
                                                    <td>{{ $peminjamanditerima->userLog->nama }}</td>
                                                    <td>{{ $peminjamanditerima->userLog->no_telp }}</td>
                                                    <td>{{ $peminjamanditerima->dbsarana->nama_sarana }}</td>
                                                    <td>{{ $peminjamanditerima->jumlah }}</td>
                                                    <td>{{ $peminjamanditerima->tanggal_pinjam }}</td>
                                                    <td>
                                                        <span class="{{ $today > $peminjamanditerima->tanggal_kembali ? 'text-danger' : '' }}">
                                                            {{ $peminjamanditerima->tanggal_kembali }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $peminjamanditerima->keterangan }}</td>
                                                    <td><span class="badge bg-success">{{ $peminjamanditerima->status }}</span></td>
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
