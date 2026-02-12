<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conteo extends Model
{
    use HasFactory;

    protected $fillable = [
        'fraternidad_id',
        'cantidad_integrantes',
        'bloques',
        'ubicacion',
        'turno',
        'contador_id',
        'gestion_id',
        'varones',
        'mujeres',
    ];

    public function gestion()
    {
        return $this->belongsTo(Gestion::class);
    }

    // Relación con Fraternidad (Uno a Muchos)
    public function fraternidad()
    {
        return $this->belongsTo(Fraternidad::class);
    }

    // Relación con Banda (Uno a Muchos, Opcional)
    public function banda()
    {
        return $this->belongsTo(Banda::class);
    }

    // Relación con Usuario (Contador que registró el conteo)
    public function contador()
    {
        return $this->belongsTo(User::class, 'contador_id');
    }

    // Relación con ConteoBanda
    //public function conteoBandas()
    //{
    //    return $this->hasMany(ConteoBanda::class, 'fraternidad_id', 'fraternidad_id');
    //}
}
