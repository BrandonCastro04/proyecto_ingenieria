<?php

namespace Database\Factories;

use App\Models\viaje;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\pasajero;
use App\Models\metodo_pago;

class ViajeFactory extends Factory
{
    protected $model = viaje::class;

    public function definition()
    {
        return [
            'origen' => $this->faker->city,
            'destino' => $this->faker->city,
            'fecha' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'pasajero_id' => pasajero::factory(),
            'metodo_pago_id' => metodo_pago::factory(),
        ];
    }
}
