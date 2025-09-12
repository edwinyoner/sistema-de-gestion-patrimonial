<!DOCTYPE html> 
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer contraseña - Sistema de Gestión Patrimonial</title>
    <style type="text/css">
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            text-align: center;
            padding: 30px 20px;
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: #ffffff;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .content {
            padding: 30px;
        }
        .reset-section {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            border-radius: 8px;
            padding: 25px;
            text-align: center;
            margin-bottom: 30px;
        }
        .reset-section h3 {
            color: #1976d2;
            margin-top: 0;
            margin-bottom: 15px;
        }
        .reset-section p {
            color: #424242;
            margin-bottom: 20px;
        }
        .btn-reset {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 600;
            font-size: 16px;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
            transition: all 0.3s ease;
        }
        .btn-reset:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
        }
        .security-note {
            background: #f8d7da;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 20px;
            border-left: 4px solid #dc3545;
        }
        .security-note p {
            color: #721c24;
            margin: 0;
            font-size: 14px;
        }
        .footer {
            background-color: #343a40;
            color: #ffffff;
            text-align: center;
            padding: 25px;
        }
        .footer p {
            margin: 5px 0;
            font-size: 14px;
        }
        .footer a {
            color: #17a2b8;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1>Sistema de Gestión Patrimonial</h1>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="reset-section">
                <h3>🔑 Restablecer tu contraseña</h3>
                <p>Hola <strong>{{ $user->name }}</strong>, hemos recibido una solicitud para restablecer tu contraseña.</p>
                <a href="{{ $url }}" class="btn-reset">Restablecer contraseña</a>
                <p style="font-size: 12px; color: #666; margin-top: 15px;">
                    Este enlace expirará en <strong>60 minutos</strong>.<br>
                    Si tienes problemas con el botón, copia y pega esta URL en tu navegador:<br>
                    <span style="word-break: break-all; color: #007bff;">{{ $url }}</span>
                </p>
            </div>

            <!-- Security Note -->
            <div class="security-note">
                <p><strong>⚠️ Importante:</strong> Si no solicitaste este restablecimiento, puedes ignorar este mensaje de manera segura.</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; {{ date('Y') }} Sistema de Gestión Patrimonial. Todos los derechos reservados.</p>
            <p>¿Necesitas ayuda? Contáctanos en 
                <a href="mailto:support@winner-systems.com">support@winner-systems.com</a>
            </p>
            <p>Este correo fue enviado a {{ $user->email }}</p>
        </div>
    </div>
</body>
</html>
