<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Conteo;
use App\Models\ConteoBanda;
use Illuminate\Http\Request;

class ConteoController extends Controller
{
    public function index(Request $request)
    {
        $query = Conteo::with(['fraternidad', 'gestion']);

        if ($request->has('gestion_id')) {
            $query->where('gestion_id', $request->gestion_id);
        } else {
            // Default to active gestion
            $query->whereHas('gestion', function ($q) {
                $q->where('activo', true);
            });
        }

        $conteos = $query->get();

        $result = $conteos->map(function ($conteo) {
            $conteosBandas = ConteoBanda::where('fraternidad_id', $conteo->fraternidad_id)
                ->where('gestion_id', $conteo->gestion_id)
                ->with('banda')
                ->get();

            return [
                'id' => $conteo->id,
                'fraternidad' => $conteo->fraternidad->nombre,
                'fraternidad_id' => $conteo->fraternidad_id,
                'ubicacion' => $conteo->ubicacion,
                'cantidad_fraternidad' => $conteo->cantidad_integrantes,
                'varones' => $conteo->varones,
                'mujeres' => $conteo->mujeres,
                'gestion_id' => $conteo->gestion_id,
                'gestion_nombre' => $conteo->gestion?->nombre,
                'contador_id' => $conteo->contador_id,
                'bandas' => $conteosBandas->map(function ($conteoBanda) {
                    return [
                        'id' => $conteoBanda->banda_id,
                        'nombre' => $conteoBanda->banda->nombre,
                        'cantidad_' => $conteoBanda->cantidad_integrantes,
                        'varones' => $conteoBanda->varones,
                        'mujeres' => $conteoBanda->mujeres,
                        'ubicacion' => $conteoBanda->ubicacion,
                        'contador_id' => $conteoBanda->contador_id,
                    ];
                }),
                'total_bandas' => $conteosBandas->count(),
            ];
        });

        return response()->json([
            'status' => 'success',
            'data' => $result
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'fraternidad_id' => 'required|exists:fraternidades,id',
            'cantidad_integrantes' => 'required|integer|min:0',
            'varones' => 'required|integer|min:0',
            'mujeres' => 'required|integer|min:0',
            'bloques' => 'required|integer|min:1',
            'ubicacion' => 'required',
            'turno' => 'nullable',
            'contador_id' => 'required|exists:users,id',
            'gestion_id' => 'required|exists:gestiones,id',
        ]);

        $conteo = Conteo::create($request->all());
        return response()->json($conteo, 201);
    }

    public function show($id)
    {
        $conteo = Conteo::with(['fraternidad', 'banda', 'contador'])->find($id);
        if (!$conteo) {
            return response()->json(['error' => 'Conteo no encontrado'], 404);
        }
        return response()->json($conteo, 200);
    }

    public function update(Request $request, $id)
    {
        $conteo = Conteo::find($id);
        if (!$conteo) {
            return response()->json(['error' => 'Conteo no encontrado'], 404);
        }

        $request->validate([
            'cantidad_integrantes' => 'integer|min:1',
            'bloques' => 'integer|min:1',
            'ubicacion' => 'in:Av. 6 de agosto,Plaza',
            'turno' => 'in:mañana,tarde,noche,amanecer',
        ]);

        $conteo->update($request->all());
        return response()->json($conteo, 200);
    }

    public function destroy($id)
    {
        $conteo = Conteo::find($id);
        if (!$conteo) {
            return response()->json(['error' => 'Conteo no encontrado'], 404);
        }

        $conteo->delete();
        return response()->json(['message' => 'Conteo eliminado'], 200);
    }
}
