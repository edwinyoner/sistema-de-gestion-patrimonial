<!DOCTYPE html>
<html>
<head>
    <title>Credenciales de Acceso</title>
</head>
<body>
    <h1>Bienvenido al Sistema de Gestión, {{ $user->name }}</h1>
    <p>Sus credenciales iniciales son:</p>
    <ul>
        <li><strong>Correo:</strong> {{ $user->email }}</li>
        <li><strong>Contraseña:</strong> {{ $password }}</li>
    </ul>
    <p>Por favor, inicie sesión en el siguiente link: <a href="{{ $loginUrl }}" target="_blank">{{ $loginUrl }}</a> y cambie su contraseña al primer acceso.</p>
    <p>Nota: Debe cambiar su contraseña ya que está configurada para obligar el cambio en el primer inicio.</p>
</body>
</html>