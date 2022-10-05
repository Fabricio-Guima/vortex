<?php

namespace App\Mail;

use App\Events\TriggerEmailEvent;
use App\Models\Agenda;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailMessage extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $agenda;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Agenda $agenda)
    {
        $this->agenda = $agenda;
        dd($this->agenda);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.view')->subject($this->agenda['assunto']);
    }
}
