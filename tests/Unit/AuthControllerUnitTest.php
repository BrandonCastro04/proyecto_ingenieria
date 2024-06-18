<?php


namespace Tests\Unit;

use Tests\TestCase; 
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Models\Pasajero;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mockery;

class AuthControllerUnitTest extends TestCase // Extiende TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware();
    
        $this->controller = $this->app->make(AuthController::class);
    }

    public function testRegister()
    {
  
        $request = Request::create('/register', 'POST', [
            'username' => 'john_doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ]);

        $response = $this->controller->register($request);

  
        $this->assertEquals(201, $response->status());
        $this->assertDatabaseHas('pasajeros', [
            'username' => 'john_doe',
            'email' => 'john@example.com',
        ]);
    }
}