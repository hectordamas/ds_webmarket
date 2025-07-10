<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre'     => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'negocio'    => 'required|string|max:255',
            'whatsapp'   => 'required|string|max:50',
            'actividad'  => 'required|string|max:500',
            'instagram'  => 'nullable|string|max:255',
            'autorizo'   => 'required|in:1',
        ];
    }
}
