<?php

namespace App\Http\Controllers;

use App\Models\viaje;
use Illuminate\Http\Request;

class ViajeController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'origen' => 'required|string|max:255',
            'destino' => 'required|string|max:255',
            'fecha' => 'required|date',
            'pasajero_id' => 'required|exists:pasajeros,id',
            'metodo_pago_id' => 'required|exists:metodo_pago,id',
        ]);

        $viaje = viaje::create([
            'origen' => $request->origen,
            'destino' => $request->destino,
            'fecha' => $request->fecha,
            'pasajero_id' => $request->pasajero_id,
            'metodo_pago_id' => $request->metodo_pago_id,
        ]);

        return response()->json(['message' => 'Viaje creado correctamente.'], 201);
    }
    public function index()
    {
        $viajes = viaje::with(['pasajero', 'metodo_pago'])->get();
        return response()->json($viajes);
    }
}
