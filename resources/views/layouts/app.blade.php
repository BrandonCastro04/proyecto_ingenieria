<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto Uber</title>
    <!-- Agrega aquí tus estilos CSS o enlaces a bibliotecas externas -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        @yield('content')
    </div>

    <!-- Agrega aquí tus scripts JavaScript o enlaces a bibliotecas externas -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
