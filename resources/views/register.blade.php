<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
</head>
<body>
    <h1>Registro de Usuario</h1>
    <form action="/register" method="post">
        @csrf <!-- Agrega esto si estás utilizando el sistema de protección CSRF de Laravel -->
        <label for="username">Nombre:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="phone">Tel:</label><br>
        <input type="text" id="phone" name="phone"><br>
        <label for="email">Correo Electrónico:</label><br>
        <input type="email" id="email" name="email"><br>
        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password"><br>
        <label for="password_confirmation">Confirmar Contraseña:</label><br>
        <input type="password" id="password_confirmation" name="password_confirmation"><br><br>
        <button type="submit">Registrarse</button>
    </form>
</body>
</html>



