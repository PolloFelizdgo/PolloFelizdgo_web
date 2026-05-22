<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo mensaje de contacto | Pollo Feliz</title>
</head>
<body style="margin: 0; padding: 0; background-color: #fffaf5; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1f2937;">
    <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background-color: #fffaf5; padding: 28px 14px;">
        <tr>
            <td align="center">
                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="max-width: 640px; background-color: #ffffff; border-radius: 20px; overflow: hidden; border: 1px solid #f3f4f6;">
                    <tr>
                        <td style="background: linear-gradient(135deg, #b91c1c 0%, #dc2626 60%, #f59e0b 100%); padding: 26px 20px; text-align: center;">
                            @if(!empty($logoCid))
                                <img src="{{ $logoCid }}" alt="{{ $brandName }}" width="82" style="display: block; margin: 0 auto 10px auto; max-width: 82px; height: auto;">
                            @elseif(!empty($logoUrl))
                                <img src="{{ $logoUrl }}" alt="{{ $brandName }}" width="82" style="display: block; margin: 0 auto 10px auto; max-width: 82px; height: auto;">
                            @endif
                            <p style="margin: 0 0 10px 0; font-size: 18px; line-height: 1; color: #ffffff; font-weight: 800; letter-spacing: 0.3px;">{{ $brandName }}</p>
                            <h1 style="margin: 0; font-size: 24px; line-height: 1.3; color: #ffffff; font-weight: 800;">Nuevo mensaje de contacto</h1>
                            <p style="margin: 8px 0 0 0; font-size: 14px; color: #fde68a;">Formulario web de Pollo Feliz</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 24px 24px 8px 24px;">
                            <p style="margin: 0 0 16px 0; font-size: 15px; color: #374151;">Se recibio un nuevo contacto con la siguiente informacion:</p>

                            <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background-color: #fff7ed; border: 1px solid #fed7aa; border-radius: 14px;">
                                <tr>
                                    <td style="padding: 16px 18px; font-size: 14px; line-height: 1.6; color: #1f2937;">
                                        <p style="margin: 0 0 10px 0;"><strong style="color: #b91c1c;">Nombre:</strong> {{ $fullName }}</p>
                                        <p style="margin: 0 0 10px 0;"><strong style="color: #b91c1c;">Correo:</strong> {{ $contactData['email'] }}</p>
                                        <p style="margin: 0;"><strong style="color: #b91c1c;">Celular:</strong> {{ $contactData['phone'] }}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 10px 24px 8px 24px;">
                            <h2 style="margin: 0 0 10px 0; font-size: 17px; line-height: 1.3; color: #111827;">Mensaje del cliente</h2>
                            <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f9fafb; border: 1px solid #e5e7eb; border-radius: 14px;">
                                <tr>
                                    <td style="padding: 16px 18px; font-size: 14px; line-height: 1.7; color: #374151; white-space: pre-line;">{{ $contactData['message'] }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 18px 24px 26px 24px;">
                            <p style="margin: 0; font-size: 13px; color: #6b7280;">Responde directamente a este correo para contactar al cliente.</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="background-color: #111827; padding: 16px 20px; text-align: center;">
                            <p style="margin: 0; font-size: 12px; color: #f3f4f6;">Pollo Feliz | {{ $supportAddress }}</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
