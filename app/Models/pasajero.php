<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pasajero extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username', 'phone', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    public function metodosPago()
    {
        return $this->hasMany(metodo_pago::class);
    }

    public function viajes()
    {
        return $this->hasMany(viaje::class);
    }
}

