<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        h1 {
            color: #6a1b9a; 
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            color: #555;
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #6a1b9a; 
            color: #ffffff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #4a148c; 
        }
        .error-message {
            color: red;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Iniciar Sesión</h1>
        <form action="{{ route('login') }}" method="POST">
            @csrf 
            <label for="username">Nombre de Usuario:</label>
            <input type="text" id="username" name="username" value="{{ old('username') }}">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password">
            @if ($errors->any())
                <div class="error-message">{{ $errors->first() }}</div>
            @endif
            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>

