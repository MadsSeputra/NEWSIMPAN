<!DOCTYPE html>
<html>
<head>
    <title>Konfirmasi Pesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .content {
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Notifikasi Pengingat Pengembalian Sarana</h1>
        </div>
        <div class="content">
            <p>Yth,
            <br>{{ $nama }},</p>
            <p>Kami dari SIM Pinjam Sarana mengingatkan bahwa pinjaman Anda dengan nomor pesanan TR-{{ now()->year }}{{ str_pad(now()->month, 2, '0', STR_PAD_LEFT) }}{{ $id_peminjam }} </p>
            <p>Anda telah meminjam {{ $jumlah }} {{ $nama_sarana }} dan diharapkan untuk dikembalikan pada tanggal {{ $tanggal_kembali }}.</p>
            <p>Terima kasih telah menggunakan layanan kami. Kami harap dapat memudahkan anda dalam peminjaman sarana</p>
            <p>Jangan ragu untuk menghubungi kami jika Anda memiliki pertanyaan atau membutuhkan bantuan lebih lanjut.</p>
        </div>
        <div class="footer">
            <p>Salam hormat,</p>
            <p>Banjar Mertha Rauh | SIM PINJAM SARANA</p>
        </div>
    </div>
</body>
</html>
