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
                @elseif(Session::has('hapus'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('hapus') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                 @elseif(Session::has('notifikasi'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('notifikasi') }}
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
                                                    <td>
                                                        <span class="{{ $today > $pengembalian->tanggal_kembali ? 'bg-danger text-white' : '' }}">
                                                        TR-{{ now()->year }}{{ str_pad(now()->month, 2, '0', STR_PAD_LEFT) }}{{ $pengembalian->id }}</td>
                                                    <td>
                                                        <span class="{{ $today > $pengembalian->tanggal_kembali ? 'bg-danger text-white' : '' }}"> <!-- Mengevaluasi variabel hari ini bila lebih besar dari tanggal kembali akan mengubah menjadi text danger-->
                                                            {{ $pengembalian->userLog->nama }}  <!-- dengan mengakses database userlog dg atribut nama-->
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="{{ $today > $pengembalian->tanggal_kembali ? 'bg-danger text-white' : '' }}">
                                                            {{ $pengembalian->userLog->no_telp }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="{{ $today > $pengembalian->tanggal_kembali ? 'bg-danger text-white' : '' }}">
                                                            {{ $pengembalian->dbsarana->nama_sarana }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="{{ $today > $pengembalian->tanggal_kembali ? 'bg-danger text-white' : '' }}">
                                                            {{ $pengembalian->jumlah }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="{{ $today > $pengembalian->tanggal_kembali ? 'bg-danger text-white' : '' }}">
                                                            {{ $pengembalian->tanggal_pinjam }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="{{ $today > $pengembalian->tanggal_kembali ? 'bg-danger text-white' : '' }}">
                                                            {{ $pengembalian->tanggal_kembali }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="{{ $today > $pengembalian->tanggal_kembali ? 'bg-danger text-white' : '' }}">
                                                            {{ $pengembalian->keterangan }}
                                                        </span>
                                                    </td>
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
                                                                            <form action="{{ route('selesaipeminjaman', $pengembalian->id) }}" method="POST">
                                                                                @csrf
                                                                                <div class="mb-3 d-none">
                                                                                    <label for="id_peminjaman" class="form-label">Alasan Kerusakan</label>
                                                                                    <input type="text" class="form-control" id="id_peminjaman" name="id_peminjaman" value="{{ $pengembalian->id }}">
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="keterangan" class="form-label">Alasan Kerusakan</label>
                                                                                    <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="(-) jika tidak ada kerusakan" required>
                                                                                </div>
                                                                            
                                                                            Yakin Ingin Menyelesaikan Pengembalian Sarana ID: TR-{{ now()->year }}{{ str_pad(now()->month, 2, '0', STR_PAD_LEFT) }}{{ $pengembalian->id }}
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary">Selesai</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>                                                            
                                                            </div>
                                                        </form>
                                                        
                                                        <!-- NOTIF PENGINGAT -->
                                                        <br>
                                                        <form action="{{ route('notifikasipengingat', $pengembalian->id) }}" method="POST">
                                                            @csrf
                                                            <div class="flex items-center d-none">
                                                                <input type="email" name="recipient_email" value="{{ $pengembalian->userLog->email }}" placeholder="Alamat Email Penerima" required>
                                                            </div>
                                                            <button type="button" class="btn btn-success" style="margin-right: 5px;" data-bs-toggle="modal" data-bs-target="#konfirmasiModal-{{ $pengembalian->id }}">
                                                                Pengingat
                                                            </button>
                                                            
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="konfirmasiModal-{{ $pengembalian->id }}" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="konfirmasiModalLabel">Notifikasi Pengingat</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        
                                                                        <div class="modal-body">
                                                                            <!-- Isi konten modal di sini -->
                                                                            Yakin Ingin Mengirim Notifikasi Pengingat Pinjaman ID: TR-{{ now()->year }}{{ str_pad(now()->month, 2, '0', STR_PAD_LEFT) }}{{ $pengembalian->id }}
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                            <form action="{{ route('notifikasipengingat', $pengembalian->id) }}" method="POST">
                                                                                @csrf
                                                                                <button type="submit" class="btn btn-success">Konfirmasi</button>
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

                <section class="section">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title" style="padding-bottom: 2rem;">Keterangan Kerusakan Pengembalian</h5>

                                    <div class="table-responsive">
                                        <table class="table datatable table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Id Transaksi</th>
                                                    <th scope="col">Keterangan Pengembalian</th>
                                                    <th scope="col">Nama Peminjam</th>
                                                    <th scope="col">No Telp</th>
                                                    <th scope="col">Sarana</th>
                                                    <th scope="col">Jumlah</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($kerusakan as $key => $kerusakan)
                                                <tr>
                                                    <td>{{ $startNumber2 + $key }}</td>
                                                    <td>TR-{{ now()->year }}{{ str_pad(now()->month, 2, '0', STR_PAD_LEFT) }}{{ $kerusakan->id_peminjaman }}</td>
                                                    <td>{{ $kerusakan->keterangan }}</td>
                                                    <td>{{ $kerusakan->peminjaman->userLog->nama }}</td>
                                                    <td>{{ $kerusakan->peminjaman->userLog->no_telp }}</td>
                                                    <td>{{ $kerusakan->peminjaman->dbsarana->nama_sarana }}</td>
                                                    <td>{{ $kerusakan->peminjaman->jumlah }}</td>
                                                    <td><span class="badge bg-success">{{ $kerusakan->peminjaman->status }}</span></td>
                                                    <td class="d-flex align-items-center mt-4">
                                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $kerusakan->id }}">
                                                            Hapus
                                                        </button>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal-{{ $kerusakan->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Penghapusan Kerusakan</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Apakah Anda yakin ingin menghapus kerusakan ini?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <form action="{{ route('hapuskerusakan', $kerusakan->id) }}" method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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
