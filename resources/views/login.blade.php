<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>
<body>
    <h1>Iniciar Sesión</h1>
    <form action="{{ route('login') }}" method="POST">
        @csrf <!-- Agrega esto si estás utilizando el sistema de protección CSRF de Laravel -->
        <label for="username">Nombre de Usuario:</label><br>
        <input type="text" id="username" name="username" value="{{ old('username') }}"><br>
        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password"><br><br>
        @if ($errors->any())
            <div style="color: red;">{{ $errors->first() }}</div>
        @endif
        <button type="submit">Iniciar Sesión</button>
    </form>
</body>
</html>

