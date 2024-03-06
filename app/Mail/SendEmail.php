<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
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
        return $this->view('emails.konfirmasi_pinjaman');
    }
    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Send Email',
    //     );
    // }

    // /**
    //  * Get the message content definition.
    //  */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    // /**
    //  * Get the attachments for the message.
    //  *
    //  * @return array<int, \Illuminate\Mail\Mailables\Attachment>
    //  */
    // public function attachments(): array
    // {
    //     return [];
    // }
}
