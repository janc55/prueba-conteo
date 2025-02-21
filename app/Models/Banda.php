<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banda extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'cantidad_integrantes'];

    // Relación Muchos a Muchos con Fraternidad
    public function fraternidades()
    {
        return $this->belongsToMany(Fraternidad::class, 'banda_fraternidad');
    }

    // Relación Uno a Muchos con Conteo
    public function conteos()
    {
        return $this->hasMany(Conteo::class);
    }
}
