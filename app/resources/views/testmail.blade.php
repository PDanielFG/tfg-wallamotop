<!DOCTYPE html>
<html>
<head>
    <title>Confirmación de correo electrónico</title>
</head>
<body>
    <h1>Hola, {{ $user->name }}</h1>
    <p>Por favor, confirma tu correo electrónico haciendo clic en el siguiente enlace:</p>
    <a href="{{ $confirmationLink }}">Confirmar correo electrónico</a>
</body>
</html>
