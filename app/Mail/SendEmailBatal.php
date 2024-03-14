<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendEmailBatal extends Mailable
{
    use Queueable, SerializesModels;

    // Properti untuk menyimpan data yang akan digunakan dalam view email
    public $id_peminjam;
    public $nama;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        // Assign data ke dalam properti
        $this->id_peminjam = $data['id_peminjam'];
        $this->nama = $data['nama'];
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Menggunakan view 'konfirmasi_pesanan' dan mengirimkan data ke dalam view
        return $this->view('emails.batal_peminjaman');
    }
    
}
