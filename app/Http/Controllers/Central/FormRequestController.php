<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\FormRequest;
use App\Http\Requests\StoreFormRequest as FormValidation;
use Mail;

class FormRequestController extends Controller
{
    public function index()
    {
        $solicitudes = FormRequest::orderBy('id', 'desc')->get();

        return view('central.admin.formRequests.index', compact('solicitudes'));
    }

    public function store(FormValidation $request)
    {
        // Guardar en la base de datos
        $form = FormRequest::create($request->validated());

        $datos = $form->toArray();

        // Enviar correo directamente
        Mail::send('emails.formulario', $form->toArray(), function ($message) {
            $message->to('hectorgabrieldm@hotmail.com')->subject('Nuevo formulario de prueba gratis');
        });

        return redirect()->back()->with('success', '¡Gracias! Te contactaremos pronto.');
    }
}
