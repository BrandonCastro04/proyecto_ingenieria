<?php

namespace App\Http\Controllers;

use App\Models\metodo_pago;
use Illuminate\Http\Request;

 class PagoController extends Controller
{
 
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'pasajero_id' => 'required|exists:pasajeros,id',
            'type' => 'required|string',
            'details' => 'required|string',
        ]);

        // Crear el método de pago
        MetodoPago::create([
            'pasajero_id' => $request->pasajero_id,
            'type' => $request->type,
            'details' => $request->details,
        ]);

        // Redirigir o retornar respuesta
        return redirect()->route('ruta.deseada')->with('success', 'Método de pago agregado exitosamente.');
    }
}