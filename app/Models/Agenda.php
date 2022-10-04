<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agendas';

    protected $fillable = [
        'nome',
        'email',
        'assunto',
        'corpo_email',
        'agendar'
    ];

    protected $casts = [
        'agendar' => 'datetime',
    ];
}
