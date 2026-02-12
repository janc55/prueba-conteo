<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gestion extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'anio', 'activo'];

    protected $casts = [
        'activo' => 'boolean',
    ];

    public function conteos()
    {
        return $this->hasMany(Conteo::class);
    }

    public function conteoBandas()
    {
        return $this->hasMany(ConteoBanda::class);
    }
}
