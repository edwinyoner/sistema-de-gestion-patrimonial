<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido - Sistema de Gestión Patrimonial</title>
    <style type="text/css">
        /* Estilos inline y básicos para correos */
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
        .welcome-section {
            text-align: center;
            margin-bottom: 30px;
        }
        .welcome-section h2 {
            color: #333;
            font-size: 28px;
            margin-bottom: 10px;
        }
        .welcome-section p {
            color: #666;
            font-size: 16px;
            margin-bottom: 20px;
        }
        .credentials-box {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 30px;
            border-left: 4px solid #007bff;
        }
        .credentials-box h3 {
            color: #007bff;
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 18px;
        }
        .credential-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding: 10px;
            background: #ffffff;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .credential-label {
            font-weight: 600;
            color: #495057;
            width: 100px;
            flex-shrink: 0;
        }
        .credential-value {
            color: #212529;
            font-family: 'Courier New', monospace;
            font-size: 14px;
            word-break: break-all;
        }
        .verification-section {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            border-radius: 8px;
            padding: 25px;
            text-align: center;
            margin-bottom: 30px;
        }
        .verification-section h3 {
            color: #1976d2;
            margin-top: 0;
            margin-bottom: 15px;
        }
        .verification-section p {
            color: #424242;
            margin-bottom: 20px;
        }
        .btn-verify {
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
        .btn-verify:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
        }
        .login-section {
            background: #fff3cd;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 4px solid #ffc107;
        }
        .login-section h4 {
            color: #856404;
            margin-top: 0;
            margin-bottom: 10px;
        }
        .login-section p {
            color: #856404;
            margin-bottom: 15px;
        }
        .btn-login {
            display: inline-block;
            padding: 10px 25px;
            background-color: #007bff;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 500;
        }
        .btn-login:hover {
            background-color: #0056b3;
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
        
        /* Responsive */
        @media only screen and (max-width: 600px) {
            .email-container {
                margin: 10px;
                width: auto;
            }
            .content {
                padding: 20px;
            }
            .credential-item {
                flex-direction: column;
                align-items: flex-start;
            }
            .credential-label {
                width: auto;
                margin-bottom: 5px;
            }
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
            <!-- Welcome Section -->
            <div class="welcome-section">
                <h2>¡Bienvenido, {{ $user->name }}!</h2>
                <p>Te damos la bienvenida a nuestro Sistema de Gestión Patrimonial. Tu cuenta ha sido creada exitosamente.</p>
            </div>

            <!-- Email Verification Section -->
            <div class="verification-section">
                <h3>📧 Confirma tu dirección de correo electrónico</h3>
                <p>Para garantizar la seguridad de tu cuenta, necesitamos verificar tu dirección de correo electrónico antes de que puedas acceder completamente al sistema.</p>
                <a href="{{ $verificationUrl }}" class="btn-verify">Confirme su correo electrónico</a>
                <p style="font-size: 12px; color: #666; margin-top: 15px;">
                    Si tienes problemas con el botón, copia y pega este enlace en tu navegador:<br>
                    <span style="word-break: break-all; color: #007bff;">{{ $verificationUrl }}</span>
                </p>
            </div>

            <!-- Credentials Section -->
            <div class="credentials-box">
                <h3>🔐 Tus credenciales de acceso</h3>
                <p>Una vez que hayas verificado tu correo, podrás iniciar sesión con las siguientes credenciales:</p>
                
                <div class="credential-item">
                    <div class="credential-label">Correo:</div>
                    <div class="credential-value">{{ $user->email }}</div>
                </div>
                
                <div class="credential-item">
                    <div class="credential-label">Contraseña:</div>
                    <div class="credential-value">{{ $password }}</div>
                </div>
            </div>

            <!-- Login Section -->
            <div class="login-section">
                <h4>🌐 Accede al sistema</h4>
                <p>Después de verificar tu correo, puedes iniciar sesión en:</p>
                <a href="{{ $loginUrl }}" class="btn-login" target="_blank">Ir al Sistema</a>
            </div>

            <!-- Security Note -->
            <div class="security-note">
                <p><strong>⚠️ Importante:</strong> Por tu seguridad, te recomendamos cambiar tu contraseña temporal después del primer inicio de sesión. Guarda estas credenciales en un lugar seguro.</p>
            </div>

            <!-- Additional Info -->
            <p style="color: #666; font-size: 14px; text-align: center;">
                <strong>Nota:</strong> Si no has solicitado esta cuenta, puedes ignorar este correo de forma segura. La cuenta será eliminada automáticamente si no se verifica en 24 horas.
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; {{ date('Y') }} Sistema de Gestión Patrimonial. Todos los derechos reservados.</p>
            <p>¿Necesitas ayuda? Contáctanos en <a href="mailto:support@winner-systems.com">support@winner-systems.com</a></p>
            <p>Este correo fue enviado a {{ $user->email }}</p>
        </div>
    </div>
</body>
</html>