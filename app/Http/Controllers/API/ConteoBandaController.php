<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ConteoBanda;
use Illuminate\Http\Request;

class ConteoBandaController extends Controller
{
    // Listar todos los conteos de bandas
    public function index(Request $request)
    {
        $query = ConteoBanda::with(['banda', 'fraternidad', 'contador', 'gestion']);

        if ($request->has('gestion_id')) {
            $query->where('gestion_id', $request->gestion_id);
        } else {
            $query->whereHas('gestion', function ($q) {
                $q->where('activo', true);
            });
        }

        return $query->get();
    }

    // Crear un nuevo conteo de banda
    public function store(Request $request)
    {
        $request->validate([
            'banda_id' => 'required|exists:bandas,id',
            'fraternidad_id' => 'required|exists:fraternidades,id',
            'cantidad_integrantes' => 'required|integer|min:0',
            'varones' => 'required|integer|min:0',
            'mujeres' => 'required|integer|min:0',
            'ubicacion' => 'required|string',
            'turno' => 'nullable|string',
            'contador_id' => 'required|exists:users,id',
            'gestion_id' => 'required|exists:gestiones,id',
        ]);

        $conteoBanda = ConteoBanda::create($request->all());

        // Sincronizar la relación muchos a muchos
        $conteoBanda->banda->fraternidades()->sync($request->fraternidad_id);

        return response()->json($conteoBanda, 201);
    }

    // Mostrar un conteo de banda específico
    public function show(ConteoBanda $conteoBanda)
    {
        return $conteoBanda->load(['banda', 'fraternidad', 'contador']);
    }

    // Actualizar un conteo de banda
    public function update(Request $request, ConteoBanda $conteoBanda)
    {
        $request->validate([
            'banda_id' => 'sometimes|exists:bandas,id',
            'fraternidad_id' => 'sometimes|exists:fraternidades,id',
            'cantidad_integrantes' => 'sometimes|integer|min:1',
            'ubicacion' => 'sometimes|string',
            'turno' => 'nullable|string',
            'contador_id' => 'sometimes|exists:users,id'
        ]);

        $conteoBanda->update($request->all());

        return response()->json($conteoBanda);
    }

    // Eliminar un conteo de banda
    public function destroy(ConteoBanda $conteoBanda)
    {
        $conteoBanda->delete();
        return response()->json(['message' => 'Conteo eliminado'], 204);
    }

    public function bandasPorFraternidad($fraternidadId)
    {
        $conteos = ConteoBanda::where('fraternidad_id', $fraternidadId)
            ->with('banda')
            ->get();

        $bandas = $conteos->map(function ($conteo) {
            return [
                'nombre' => $conteo->banda->nombre,
                'integrantes' => $conteo->cantidad_integrantes,
                'user_id' => $conteo->contador_id
            ];
        });

        return response()->json($bandas);
    }
}
