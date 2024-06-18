<!-- resources/views/dashboard.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>¡Bienvenido, {{ $pasajero->username }}!</h1>
        <p>Correo electrónico: {{ $pasajero->email }}</p>
        <p>Teléfono: {{ $pasajero->phone }}</p>
        <!-- Agrega más información del pasajero según sea necesario -->
    </div>
@endsection

