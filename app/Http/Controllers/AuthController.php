<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\pasajero;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Depura los datos recibidos del formulario  dd($request->all());
       
        try {
            $request->validate([
                'username' => 'required|unique:pasajeros',
                'phone' => 'required',
                'email' => 'required|email|unique:pasajeros',
                'password' => 'required|min:1|confirmed',
            ]);
    
            $pasajero =   pasajero::create([
                'username' => $request->username,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => bcrypt($request->password),

            ]);
    
         
            return response()->json([
                'message' => 'Registro exitoso.',
                'id' => $pasajero->id
            ], 201);

           } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'message' => 'Datos de validación inválidos.',
            'errors' => $e->errors()
        ], 422);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error en el registro.',
            'error' => $e->getMessage()
        ], 500);
    }
    }
   
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
    
        if (Auth::guard('pasajero')->attempt($credentials)) {
            $user = Auth::guard('pasajero')->user();
            return response()->json(['user' => $user], 200);
        }
    
        return response()->json(['message' => 'Nombre de usuario o contraseña incorrectos'], 401);
    }
    

    public function logout()
    {
        Auth::guard('pasajero')->logout();
        return redirect('/login');
    }

    public function showRegistrationForm()
    {
        return view('welcome');
    }

    public function showLoginForm()
    {
        return view('welcome');
    }
    public function dashboard()
    {
        // Obtener el usuario autenticado (pasajero)
        $pasajero = Auth::guard('pasajero')->user();
        return view('dashboard', compact('pasajero'));
    }
}