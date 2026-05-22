<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ContactController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        // Validacion principal del formulario de contacto.
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['required', 'string', 'min:10', 'max:20'],
            'message' => ['required', 'string', 'min:10', 'max:1000'],
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'last_name.required' => 'Los apellidos son obligatorios.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingresa un correo electrónico válido.',
            'phone.required' => 'El celular es obligatorio.',
            'message.required' => 'El mensaje es obligatorio.',
            'message.min' => 'El mensaje debe tener al menos 10 caracteres.',
        ]);

        try {
            // Destino configurable para permitir cambios por entorno sin tocar codigo.
            $supportAddress = (string) config('mail.support_address', 'soporte@pollofelizdgo.com');

            Mail::to($supportAddress)->send(new ContactFormMail($validated));
        } catch (Throwable $exception) {
            // Se registra el error tecnico y se regresa mensaje amigable al usuario.
            report($exception);

            return back()
                ->withInput()
                ->withErrors([
                    'contact_form' => 'No se pudo enviar tu mensaje en este momento. Intenta nuevamente en unos minutos.',
                ]);
        }

        // Confirmacion visual en la interfaz al terminar el envio.
        return back()->with('success', 'Tu mensaje fue enviado correctamente. Pronto nos pondremos en contacto contigo.');
    }
}