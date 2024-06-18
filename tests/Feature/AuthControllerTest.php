<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\pasajero;
use App\Models\metodo_pago;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_registers_a_new_pasajero()
    {
        $data = [
            'username' => 'nuevo_usuario',
            'phone' => '123456789',
            'email' => 'nuevo@ejemplo.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->postJson('/register', $data);

        $response->assertStatus(201)
                 ->assertJsonStructure(['message', 'id']);

        $this->assertDatabaseHas('pasajeros', [
            'username' => 'nuevo_usuario',
            'phone' => '123456789',
            'email' => 'nuevo@ejemplo.com',
        ]);
    }

    public function test_fails_registration_with_invalid_data()
    {
        $data = [
            'username' => '', // username vacío
            'phone' => '123456789',
            'email' => 'no-es-email',
            'password' => 'short', 
            'password_confirmation' => 'not_matching',
        ];

        $response = $this->postJson('/register', $data);

        $response->assertStatus(422)
                 ->assertJsonStructure(['message', 'errors']);

        $this->assertDatabaseMissing('pasajeros', [
            'email' => 'no-es-email'
        ]);
    }

 
    
    public function test_fails_to_log_in_with_invalid_credentials()
    {
        $pasajero = pasajero::factory()->create([
            'username' => 'usuario_existente',
            'password' => Hash::make('password'),
        ]);

        $response = $this->postJson('/login', [
            'username' => 'usuario_existente',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(401)
                 ->assertJson(['message' => 'Nombre de usuario o contraseña incorrectos']);
    }

   

  

}