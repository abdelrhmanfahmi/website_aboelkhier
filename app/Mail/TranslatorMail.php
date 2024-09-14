<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TranslatorMail extends Mailable
{
    use Queueable, SerializesModels;

    public $recieveReset;

    public function __construct($recieveReset)
    {
        $this->recieveReset = $recieveReset;
    }


    public function build()
    {
        return $this->subject('Mail from Aboulkhier.com')
                    ->view('emails.translatorMail');
    }
}
