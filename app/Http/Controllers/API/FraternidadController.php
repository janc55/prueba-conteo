<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Fraternidad;
use Illuminate\Http\Request;

class FraternidadController extends Controller
{
    public function index()
    {
        $fraternidades = Fraternidad::with('conteos')->get();

        return response()->json($fraternidades->map(function ($fraternidad) {
            return [
                'id' => $fraternidad->id,
                'nombre' => $fraternidad->nombre,
                'grupo' => $fraternidad->grupo,
                'tipo_danza' => $fraternidad->tipo_danza,
                'promedio_integrantes' => $fraternidad->promedio_integrantes,
                'moda_integrantes' => $fraternidad->moda_integrantes,
                'promedio_bloques' => $fraternidad->promedio_bloques,
                'moda_bloques' => $fraternidad->moda_bloques
            ];
        }));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|unique:fraternidades',
            'tipo_danza' => 'required|string',
            'cantidad_integrantes' => 'integer|min:0',
            'bloques' => 'integer|min:0',
        ]);

        $fraternidad = Fraternidad::create($request->all());
        return response()->json($fraternidad, 201);
    }

    public function show($id)
    {
        $fraternidad = Fraternidad::with('bandas')->find($id);
        if (!$fraternidad) {
            return response()->json(['error' => 'Fraternidad no encontrada'], 404);
        }
        return response()->json($fraternidad, 200);
    }

    public function update(Request $request, $id)
    {
        $fraternidad = Fraternidad::find($id);
        if (!$fraternidad) {
            return response()->json(['error' => 'Fraternidad no encontrada'], 404);
        }

        $request->validate([
            'nombre' => 'string|unique:fraternidades,nombre,' . $id,
            'tipo_danza' => 'string',
            'cantidad_integrantes' => 'integer|min:0',
            'bloques' => 'integer|min:0',
        ]);

        $fraternidad->update($request->all());
        return response()->json($fraternidad, 200);
    }

    public function destroy($id)
    {
        $fraternidad = Fraternidad::find($id);
        if (!$fraternidad) {
            return response()->json(['error' => 'Fraternidad no encontrada'], 404);
        }
        
        $fraternidad->delete();
        return response()->json(['message' => 'Fraternidad eliminada'], 200);
    }
}
