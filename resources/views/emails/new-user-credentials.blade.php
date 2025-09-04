<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credenciales de Acceso - Sistema de Gestión</title>
    <style type="text/css">
        /* Estilos inline y básicos para correos */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding: 10px;
            background-color: #007bff;
            color: #ffffff;
            border-radius: 8px 8px 0 0;
        }
        .content {
            padding: 20px;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            padding: 10px;
            border-top: 1px solid #eee;
            margin-top: 20px;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        @media only screen and (max-width: 600px) {
            .container {
                width: 100% !important;
                padding: 10px;
            }
            .header {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Sistema de Gestión Patrimonial</h2>
        </div>
        <div class="content">
            <h1>Bienvenido, {{ $user->name }}</h1>
            <p>Gracias por unirte a nuestro sistema. A continuación, te proporcionamos tus credenciales iniciales:</p>
            <ul>
                <li><strong>Correo:</strong> {{ $user->email }}</li>
                <li><strong>Contraseña:</strong> {{ $password }}</li>
            </ul>
            <p>Por favor, inicia sesión en el siguiente enlace: <a href="{{ $loginUrl }}" target="_blank">{{ $loginUrl }}</a> y cambia tu contraseña al primer acceso.</p>
            <p><strong>Nota importante:</strong> Debes cambiar tu contraseña al iniciar sesión, ya que está configurada para requerir un cambio obligatorio en el primer acceso.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Sistema de Gestión Patrimonial. Todos los derechos reservados.</p>
            <p>Si tienes alguna duda, contáctanos en <a href="mailto:support@winner-systems.com">support@winner-systems.com</a>.</p>
        </div>
    </div>
</body>
</html>