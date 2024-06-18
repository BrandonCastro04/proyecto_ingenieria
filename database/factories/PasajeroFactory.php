<?php

namespace Database\Factories;

use App\Models\pasajero;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class PasajeroFactory extends Factory
{
    protected $model = pasajero::class;

    public function definition()
    {
        return [
            'username' => $this->faker->unique()->userName,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'), // Default password
        ];
    }
}
