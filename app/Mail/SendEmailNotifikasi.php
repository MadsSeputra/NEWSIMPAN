<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendEmailNotifikasi extends Mailable
{
    use Queueable, SerializesModels;

    // Properti untuk menyimpan data yang akan digunakan dalam view email || variabel nya disesuaikan dengan bagian view email di resorces ||View
    public $id_peminjam;
    public $nama;
    public $nama_sarana;
    public $jumlah;
    public $tanggal_kembali;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        // Assign data ke dalam properti
        $this->id_peminjam = $data['id_peminjam'];
        $this->nama = $data['nama'];
        $this->nama_sarana = $data['nama_sarana'];
        $this->jumlah = $data['jumlah'];
        $this->tanggal_kembali = $data['tanggal_kembali'];
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Menggunakan view 'konfirmasi_pesanan' dan mengirimkan data ke dalam view
        return $this->view('emails.notifikasi_pinjaman');
    }
    
}
