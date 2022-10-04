<?php

namespace App\Console\Commands;

use App\Mail\SendEmailMessage;
use App\Models\Agenda;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendReportEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para enviar email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $agenda = [
        //     'email' => 'fsgkof@gmail.com',
        //     'nome' => 'kkkkkkk',
        //     'assunto' => 'Assunto',
        //     'corpo_email' => 'dgdhhjghjghjkdofkjsdoifjsdifjsidofjsdoifjsdiofjsdifjsdoifj'
        // ];
        $agenda = Agenda::first();


        Mail::to($agenda->email)->send(new SendEmailMessage($agenda));
    }
}
