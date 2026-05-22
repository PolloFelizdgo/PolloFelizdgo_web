<?php

namespace Tests\Feature;

use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    public function test_contact_form_sends_email_to_support_address(): void
    {
        Mail::fake();

        $payload = [
            'name' => 'Juan',
            'last_name' => 'Perez',
            'email' => 'juan@example.com',
            'phone' => '6181234567',
            'message' => 'Hola, quiero informacion sobre promociones familiares.',
        ];

        $response = $this->post(route('contact.store'), $payload);

        $response->assertSessionHas('success');

        Mail::assertSent(ContactFormMail::class, function (ContactFormMail $mail) use ($payload) {
            return $mail->hasTo('soporte@pollofelizdgo.com')
                && $mail->contactData['email'] === $payload['email']
                && $mail->contactData['name'] === $payload['name'];
        });
    }
}
