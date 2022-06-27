<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Str;
use Illuminate\Queue\SerializesModels;

class SendEinsatzbestaetigung extends Mailable
{
    use Queueable, SerializesModels;

    public $pdf;
    public $name;
    public $nr;
    public $at;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pdf,$name,$nr,$at)
    {
        $this->pdf = $pdf;
        $this->name = $name;
        $this->nr = $nr;
        $this->at = $at;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->from(config("mail.from.address"),'Intranet - Freiw. Feuerwehr Wiesbaden-Dotzheim')
        ->with([
            'name' => $this->name,
            'nr' => $this->nr,
            'at' => $this->at,
        ])
        ->subject("Bestätigung über die Teilnahme am Einsatz - ".config("app.name"))
        ->attachData($this->pdf->output(),'Bestaetigung-Einsatz-'.Str::snake($this->nr.'-'.$this->name).".pdf");
        return $this->view('mail.bestaetigung');
    }
}
