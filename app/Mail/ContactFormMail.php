<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public array $contactData)
    {
    }

    public function build(): self
    {
        // Nombre completo para encabezado del correo y Reply-To legible.
        $fullName = trim(($this->contactData['name'] ?? '').' '.($this->contactData['last_name'] ?? ''));
        $logoPath = public_path('images/logo.png');
        $logoUrl = file_exists($logoPath) ? asset('images/logo.png') : null;
        $logoCid = file_exists($logoPath) ? $this->embed($logoPath) : null;
        $brandName = (string) config('app.name', 'Pollo Feliz');

        return $this
            ->subject('Nuevo mensaje de contacto - Pollo Feliz')
            // Permite responder al correo del cliente directamente desde la bandeja.
            ->replyTo($this->contactData['email'] ?? '', $fullName)
            ->view('emails.contact-form')
            ->text('emails.contact-form-plain')
            ->with([
                // Se comparte CID + URL para maximizar compatibilidad en clientes de correo.
                'logoCid' => $logoCid,
                'logoUrl' => $logoUrl,
                'brandName' => $brandName,
                'fullName' => $fullName,
                'supportAddress' => (string) config('mail.support_address', 'soporte@pollofelizdgo.com'),
            ]);
    }
}
