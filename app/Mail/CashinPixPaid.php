<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CashinPixPaid extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $from__;
    public $subject__;
    public $parametros;


    public function __construct($subject__, $parametros)
    {
        $this->from__ = env('MAIL_FROM_ADDRESS_NO_REPLY');
        $this->subject__ = $subject__;
        $this->parametros = $parametros;
    }

    public function build()
    {
        return $this->from($this->from__, 'BrazaBet')->subject($this->subject__)
            ->view("email.cashIn-pix-paid")
            ->with([
                'parametros' => $this->parametros,
            ]);
    }
}
