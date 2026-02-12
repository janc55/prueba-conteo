<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConteoBanda extends Model
{
    use HasFactory;

    protected $table = 'conteo_bandas';

    protected $fillable = [
        'banda_id',
        'fraternidad_id',
        'cantidad_integrantes',
        'varones',
        'mujeres',
        'ubicacion',
        'turno',
        'contador_id',
        'gestion_id',
    ];

    public function gestion()
    {
        return $this->belongsTo(Gestion::class);
    }

    // Relación con Banda
    public function banda()
    {
        return $this->belongsTo(Banda::class);
    }

    // Relación con Fraternidad
    public function fraternidad()
    {
        return $this->belongsTo(Fraternidad::class);
    }

    // Relación con el Usuario que hizo el conteo
    public function contador()
    {
        return $this->belongsTo(User::class, 'contador_id');
    }

    // Relación con Conteo
    //public function conteo()
    //{
    //    return $this->belongsTo(Conteo::class, 'fraternidad_id', 'fraternidad_id');
    //}

}
