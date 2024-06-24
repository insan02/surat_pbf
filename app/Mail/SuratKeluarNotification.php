<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SuratKeluarNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $pengirim;
    public $kategori;
    public $keterangan;
    public $pdfPath;
    public $pdfFileName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pengirim, $kategori, $keterangan, $pdfPath, $pdfFileName)
    {
        $this->pengirim = $pengirim;
        $this->kategori = $kategori;
        $this->keterangan = $keterangan;
        // $this->pdfPath = $pdfPath;
        // $this->pdfFileName = $pdfFileName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Surat Masuk Baru')
                    ->view('emails.suratkeluar')
                    // ->attach($this->pdfPath, [
                    //     'as' => $this->pdfFileName, // Gunakan nama file yang diunggah
                    //     'mime' => 'application/pdf',
                    // ])
                    ->with([
                        'pengirim' => $this->pengirim,
                        'kategori' => $this->kategori,
                        'keterangan' => $this->keterangan,
                    ]);
    }
}
