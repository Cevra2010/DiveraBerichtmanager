<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
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
        $this->attach($this->pdf->output());
        return $this->view('mail.bestaetigung');
    }
}
