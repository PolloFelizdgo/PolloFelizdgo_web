<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ContactController extends Controller
{
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        // Validacion principal del formulario de contacto.
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['required', 'string', 'min:10', 'max:20'],
            'message' => ['required', 'string', 'min:10', 'max:1000'],
            'privacy_consent' => ['required', 'accepted'],
            'g-recaptcha-response' => ['required', 'string'],
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'last_name.required' => 'Los apellidos son obligatorios.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingresa un correo electrónico válido.',
            'phone.required' => 'El celular es obligatorio.',
            'message.required' => 'El mensaje es obligatorio.',
            'message.min' => 'El mensaje debe tener al menos 10 caracteres.',
            'privacy_consent.required' => 'Debes aceptar el Aviso de privacidad para enviar el formulario.',
            'privacy_consent.accepted' => 'Debes aceptar el Aviso de privacidad para enviar el formulario.',
            'g-recaptcha-response.required' => 'Completa el captcha antes de enviar el formulario.',
        ]);

        $captchaSecret = (string) config('services.recaptcha.secret_key');
        $captchaVerifyUrl = (string) config('services.recaptcha.verify_url');
        $captchaMinScore = (float) config('services.recaptcha.min_score', 0.5);

        if ($captchaSecret === '') {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Captcha no configurado en el servidor. Intenta de nuevo en unos minutos o contactanos por WhatsApp al (618) 129 3730.',
                ], 500);
            }

            return back()
                ->withInput()
                ->withErrors([
                    'contact_form' => 'Captcha no configurado en el servidor. Intenta de nuevo en unos minutos o contactanos por WhatsApp al (618) 129 3730.',
                ]);
        }

        $captchaResponse = Http::asForm()->post($captchaVerifyUrl, [
            'secret' => $captchaSecret,
            'response' => (string) ($validated['g-recaptcha-response'] ?? ''),
            'remoteip' => $request->ip(),
        ]);

        $captchaData = $captchaResponse->json();
        $captchaIsValid = (bool) ($captchaResponse->ok() && is_array($captchaData) && ($captchaData['success'] ?? false));

        // Si es v3, valida accion y score minimo para evitar tokens de otro flujo.
        if ($captchaIsValid && is_array($captchaData) && isset($captchaData['score'])) {
            $captchaAction = (string) ($captchaData['action'] ?? '');
            $captchaScore = (float) ($captchaData['score'] ?? 0);

            if ($captchaAction !== 'contact_form' || $captchaScore < $captchaMinScore) {
                $captchaIsValid = false;
            }
        }

        if (! $captchaIsValid) {
            if ($request->expectsJson()) {
                return response()->json([
                    'errors' => [
                        'g-recaptcha-response' => ['No se pudo validar el captcha. Intenta de nuevo.'],
                    ],
                ], 422);
            }

            return back()
                ->withInput()
                ->withErrors([
                    'g-recaptcha-response' => 'No se pudo validar el captcha. Intenta de nuevo.',
                ]);
        }

        unset($validated['g-recaptcha-response']);

        try {
            // Destino configurable para permitir cambios por entorno sin tocar codigo.
            $supportAddress = (string) config('mail.support_address', 'soporte@pollofelizdgo.com');

            Mail::to($supportAddress)->send(new ContactFormMail($validated));
        } catch (Throwable $exception) {
            // Se registra el error tecnico y se regresa mensaje amigable al usuario.
            report($exception);

            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'No se pudo enviar tu mensaje en este momento. Intenta nuevamente en unos minutos o contactanos por WhatsApp al (618) 129 3730.',
                ], 500);
            }

            return back()
                ->withInput()
                ->withErrors([
                    'contact_form' => 'No se pudo enviar tu mensaje en este momento. Intenta nuevamente en unos minutos o contactanos por WhatsApp al (618) 129 3730.',
                ]);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Tu mensaje fue enviado correctamente. Pronto nos pondremos en contacto contigo.',
            ]);
        }

        // Confirmacion visual en la interfaz al terminar el envio.
        return back()->with('success', 'Tu mensaje fue enviado correctamente. Pronto nos pondremos en contacto contigo.');
    }
}