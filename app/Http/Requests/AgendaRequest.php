<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgendaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nome' => ['required', 'string', 'min:1', 'max:255',],
            'email' => ['required', 'email'],
            'assunto' => ['required', 'string', 'min:1', 'max:255'],
            'corpo_email' => ['required', 'string', 'min:1', 'max:255'],
            'agendar' => ['nullable', 'date_format:Y-m-d H:i:s']
        ];
    }
}
