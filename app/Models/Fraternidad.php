<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fraternidad extends Model
{
    protected $table = 'fraternidades'; // 🔥 Corrige el plural en la BD
    protected $fillable = ['nombre', 'grupo', 'tipo_danza', 'cantidad_integrantes', 'bloques'];

    public function bandas()
    {
        return $this->belongsToMany(Banda::class, 'banda_fraternidad');
    }

    // Relación Uno a Muchos con Conteos
    public function conteos()
    {
        return $this->hasMany(Conteo::class);
    }

    public function getPromedioIntegrantesAttribute()
    {
        return $this->conteos()->avg('cantidad_integrantes') ?? 0;
    }

    public function getPromedioBloquesAttribute()
    {
        return $this->conteos()->avg('bloques') ?? 0;
    }
    public function getModaIntegrantesAttribute()
    {
        return $this->conteos()
            ->selectRaw('cantidad_integrantes, COUNT(*) as frecuencia')
            ->groupBy('cantidad_integrantes')
            ->orderByDesc('frecuencia')
            ->limit(1)
            ->pluck('cantidad_integrantes')
            ->first() ?? 0;
    }

    public function getModaBloquesAttribute()
    {
        return $this->conteos()
            ->selectRaw('bloques, COUNT(*) as frecuencia')
            ->groupBy('bloques')
            ->orderByDesc('frecuencia')
            ->limit(1)
            ->pluck('bloques')
            ->first() ?? 0;
    }
}
