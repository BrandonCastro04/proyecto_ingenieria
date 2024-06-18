<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class viaje extends Model
{
    use HasFactory;

    protected $fillable = [
        'origen', 'destino', 'fecha', 'pasajero_id',
    ];

    public function pasajero()
    {
        return $this->belongsTo(Pasajero::class);
    }
    public function metodoPago()
    {
        return $this->belongsTo(metodo_pago::class, 'metodo_pago_id');
    }
}
