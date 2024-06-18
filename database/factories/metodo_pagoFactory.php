<?php

namespace Database\Factories;

use App\Models\metodo_pago;
use Illuminate\Database\Eloquent\Factories\Factory;

class metodo_pagoFactory extends Factory
{
    protected $model = metodo_pago::class;

    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['Tarjeta de crédito', 'PayPal', 'Transferencia bancaria']),
            'details' => $this->faker->sentence,
        ];
    }
}
