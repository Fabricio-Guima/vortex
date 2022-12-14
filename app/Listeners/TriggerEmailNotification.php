<?php

namespace App\Listeners;

use App\Events\TriggerEmailEvent;
use App\Jobs\SendEmailJob;
use App\Mail\SendEmailMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class TriggerEmailNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(TriggerEmailEvent $event)
    {
        SendEmailJob::dispatch($event);
    }
}
