<?php

namespace Tests\Feature;

use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    public function test_contact_form_accepts_ten_consecutive_submissions(): void
    {
        Http::fake([
            'https://www.google.com/recaptcha/api/siteverify' => Http::response([
                'success' => true,
                'action' => 'contact_form',
                'score' => 0.9,
            ], 200),
        ]);

        Mail::fake();

        for ($i = 1; $i <= 10; $i++) {
            $payload = [
                'name' => 'Usuario',
                'last_name' => 'Prueba ' . $i,
                'email' => "usuario{$i}@example.com",
                'phone' => '6181234567',
                'message' => 'Mensaje de prueba de carga numero ' . $i . ' para validar 10 envios seguidos.',
                'privacy_consent' => '1',
                'g-recaptcha-response' => 'token-prueba-' . $i,
            ];

            $response = $this->post(route('contact.store'), $payload);
            $response->assertSessionHas('success');
        }

        Mail::assertSent(ContactFormMail::class, 10);
    }

    public function test_contact_form_sends_email_to_support_address(): void
    {
        Http::fake([
            'https://www.google.com/recaptcha/api/siteverify' => Http::response([
                'success' => true,
            ], 200),
        ]);

        Mail::fake();

        $payload = [
            'name' => 'Juan',
            'last_name' => 'Perez',
            'email' => 'juan@example.com',
            'phone' => '6181234567',
            'message' => 'Hola, quiero informacion sobre promociones familiares.',
            'privacy_consent' => '1',
            'g-recaptcha-response' => 'token-prueba',
        ];

        $response = $this->post(route('contact.store'), $payload);

        $response->assertSessionHas('success');

        Mail::assertSent(ContactFormMail::class, function (ContactFormMail $mail) use ($payload) {
            return $mail->hasTo('soporte@pollofelizdgo.com')
                && $mail->contactData['email'] === $payload['email']
                && $mail->contactData['name'] === $payload['name'];
        });
    }

    public function test_contact_mailable_can_be_rendered(): void
    {
        $mail = new ContactFormMail([
            'name' => 'Juan',
            'last_name' => 'Perez',
            'email' => 'juan@example.com',
            'phone' => '6181234567',
            'message' => 'Mensaje de prueba para validar renderizado del correo.',
        ]);

        $html = $mail->render();

        $this->assertStringContainsString('Nuevo mensaje de contacto', $html);
    }

    public function test_contact_form_requires_privacy_consent(): void
    {
        Http::fake([
            'https://www.google.com/recaptcha/api/siteverify' => Http::response([
                'success' => true,
            ], 200),
        ]);

        Mail::fake();

        $payload = [
            'name' => 'Juan',
            'last_name' => 'Perez',
            'email' => 'juan@example.com',
            'phone' => '6181234567',
            'message' => 'Hola, quiero informacion sobre promociones familiares.',
            'g-recaptcha-response' => 'token-prueba',
        ];

        $response = $this->from('/#contacto')->post(route('contact.store'), $payload);

        $response->assertRedirect('/#contacto');
        $response->assertSessionHasErrors('privacy_consent');

        Mail::assertNothingSent();
    }

    public function test_contact_form_requires_captcha(): void
    {
        Mail::fake();

        $payload = [
            'name' => 'Juan',
            'last_name' => 'Perez',
            'email' => 'juan@example.com',
            'phone' => '6181234567',
            'message' => 'Hola, quiero informacion sobre promociones familiares.',
            'privacy_consent' => '1',
        ];

        $response = $this->from('/#contacto')->post(route('contact.store'), $payload);

        $response->assertRedirect('/#contacto');
        $response->assertSessionHasErrors('g-recaptcha-response');

        Mail::assertNothingSent();
    }
}
