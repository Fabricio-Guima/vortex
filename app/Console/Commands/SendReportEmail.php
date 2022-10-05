<?php

namespace App\Console\Commands;

use App\Mail\SendEmailMessage;
use App\Models\Agenda;
use App\Notifications\SendEmailMessageNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

use function GuzzleHttp\Promise\each;

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
        $delay = now()->addMinutes(1);

        Agenda::all()->each(
            function (Agenda $agenda) use ($delay) {
                $agenda->notify((new SendEmailMessageNotification($agenda))->delay($delay));
                $agenda->enviado = true;
                $agenda->save();
            }

        );
    }
}
