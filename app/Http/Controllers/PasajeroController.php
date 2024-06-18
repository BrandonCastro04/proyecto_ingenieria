<?php
namespace App\Http\Controllers;

use App\Models\pasajero;
use Illuminate\Http\Request;

class PasajeroController extends Controller
{
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'username' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pasajeros',
            'password' => 'required|string|min:8',
        ]);

        // Crear el pasajero
        $pasajero = new Pasajero();
        $pasajero->username = $request->username;
        $pasajero->phone = $request->phone;
        $pasajero->email = $request->email;
        $pasajero->password = bcrypt($request->password);
        $pasajero->save();

        // retornar respuesta
        return response()->json(['id' => $pasajero->id], 201);
    }
}
