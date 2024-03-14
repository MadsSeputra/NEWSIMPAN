<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Peminjaman Dibatalkan</title>
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Tambahkan link untuk Font Awesome -->
    <style>
        @page {
            size: portrait; /* Atur ukuran halaman A4 potrait */
        }
        body {
            font-family: Arial, sans-serif;
            text-align: center; /* Tengahkan teks */
        }
        .print-button {
            display: block; /* Atur agar tombol cetak muncul sebagai blok */
            margin: 20px auto; /* Atur jarak margin di atas dan bawah serta tengahkan */
        }
        .container {
            max-width: 960px;
            margin: 0 auto; /* Mengatur margin secara otomatis untuk memposisikan elemen di tengah */
            padding: 20px;
        }
        table {
        width: 100%;
        border-collapse: collapse;
        margin-left: auto; /* Mengatur margin kiri menjadi otomatis */
        margin-right: auto; /* Mengatur margin kanan menjadi otomatis */
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 6px;
            font-size: 10pt; /* Ukuran font di dalam tabel */
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .header {
            text-align: center; /* Tengahkan teks */
            margin-bottom: 20px;
        }
        .header h1, .header h2, .header h3, .header h4, .header h5, .header h6 {
            margin: 0;
        }
        .garis {
            border: 1px solid #000;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        @php
            $downloaded = isset($_GET['download']); // Periksa apakah data sudah diunduh
        @endphp
        @unless($downloaded) <!-- Tampilkan tombol cetak jika data belum diunduh -->
        <a href="{{ route('cetakpeminjaman', ['tahun' => $tanggal->year, 'bulan' => $tanggal->month, 'status' => $status, 'download' => 1]) }}" style="position: absolute; top: 20px; right: 20px;">
            <button class="btn btn-primary" type="button"><i class="fas fa-print"></i> Cetak</button>
        </a>
        
        @endunless
        
            <h1 style="font-size: 12pt;">DESA ADAT PAGAN</h1>
            <h2 style="font-size: 16pt;">BANJAR ADAT MERTA RAUH</h2>
            <h3 style="font-size: 12pt;">KECAMATAN DENPASAR UTARA KOTA DENPASAR</h3>
            <h4 style="font-size: 12pt;">JALAN TRIJATA II DENPASAR</h4>
      
        <div class="garis"></div>
        <div class="text-center mb-3">
            <h2>SIM PINJAM SARANA</h2>
            <h3>Data Pengembalian</h3>
        </div>
        <table>
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
                <!-- Isi tabel data peminjamanbatal -->
                @foreach($peminjamanbatal as $key => $data)
                <tr>
                    <td>{{ $startNumber + $key }}</td>
                    <td>TR-{{ now()->year }}{{ str_pad(now()->month, 2, '0', STR_PAD_LEFT) }}{{ $data->id }}</td>
                    <td>{{ $data->userLog->nama }}</td>
                    <td>{{ $data->userLog->no_telp }}</td>
                    <td>{{ $data->dbsarana->nama_sarana }}</td>
                    <td>{{ $data->jumlah }}</td>
                    <td>{{ $data->tanggal_pinjam }}</td>
                    <td>{{ $data->tanggal_kembali }}</td>
                    <td>{{ $data->keterangan }}</td>
                    <td>{{ $data->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
