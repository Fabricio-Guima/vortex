<?php

namespace App\Http\Controllers;

use App\Events\TriggerEmailEvent;
use App\Http\Requests\AgendaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmailMessage;
use App\Models\Agenda;
use App\Notifications\SendEmailMessageNotification;

class AgendaController extends Controller
{
    public function disparar(AgendaRequest $request)
    {
        if (empty($request->agendar)) {
            $agenda = Agenda::create($request->validated());
            $agenda->notify(new SendEmailMessageNotification($agenda));
            $agenda->enviado = true;
            $agenda->save();
            return response()->json(['message' => 'E-mail enviado com sucesso!'], 200);
        }

        $agenda = Agenda::create($request->validated());
        return response()->json(['message' => 'Agendamento criado com sucesso!'], 200);
    }
}
