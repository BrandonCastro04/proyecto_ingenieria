<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class metodo_pago extends Model
{
    use HasFactory;
    protected $table = 'pagos';
    protected $fillable = ['pasajero_id', 'type', 'details'];

    public function pasajero()
    {
        return $this->belongsTo(pasajero::class);
    }
    public function viaje()
    {
        return $this->hasOne(viaje::class, 'id');
    }
}
