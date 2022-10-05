<?php

namespace App\Jobs;

use App\Events\TriggerEmailEvent;
use App\Mail\SendEmailMessage;
use App\Models\Agenda;
use App\Notifications\SendEmailMessageNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $event;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Agenda $event)
    {
        $this->event = $event;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Agenda::where('enviado', 0)->all()->each(function (Agenda $agenda) {
            $agenda->notify(new SendEmailMessageNotification($agenda));
            $agenda->enviado = true;
            $agenda->save();
        });

        return 'teste';
    }
}
