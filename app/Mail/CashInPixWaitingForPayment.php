<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CashInPixWaitingForPayment extends Mailable
{
    use Queueable, SerializesModels;

    public $subject__;
    public $parametros;
    public $from__;


    public function __construct($subject__, $parametros)  //Todos parametros necessarios para a view de email deverao estar contidos em $parametros, e a variavel parametros estara disponivel na view 'email.cashIn-pix-waiting-for-payment'
    {

        $this->from__ = env('MAIL_FROM_ADDRESS_NO_REPLY');
        $this->subject__ = $subject__;
        $this->parametros = $parametros;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->from__, 'BrazaBet')->subject($this->subject__)
            ->view("email.cashIn-pix-waiting-for-payment")
            ->with([
                'parametros' => $this->parametros,
            ]);
    }

}
