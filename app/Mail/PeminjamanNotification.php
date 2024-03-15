<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PeminjamanNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $namaPeminjam; // Properti untuk menyimpan nama pengguna

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($namaPeminjam)
    {
        $this->namaPeminjam = $namaPeminjam; // Setel nama pengguna dari konstruktor
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.peminjaman_notification');
    }
}
