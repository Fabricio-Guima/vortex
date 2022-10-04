<?php

namespace App\Http\Controllers;

use App\Events\TriggerEmailEvent;
use App\Http\Requests\AgendaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmailMessage;
use App\Models\Agenda;

class AgendaController extends Controller
{
    public function disparar(AgendaRequest $request)
    {
        $agenda = Agenda::create($request->validated());

        event(new TriggerEmailEvent($agenda));
    }
}
