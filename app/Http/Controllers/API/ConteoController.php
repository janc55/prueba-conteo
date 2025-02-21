<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Conteo;
use Illuminate\Http\Request;

class ConteoController extends Controller
{
    public function index()
    {
        return response()->json(Conteo::with(['fraternidad', 'banda', 'contador'])->get(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'fraternidad_id' => 'required|exists:fraternidades,id',
            'banda_id' => 'nullable|exists:bandas,id',
            'cantidad_integrantes' => 'required|integer|min:1',
            'bloques' => 'required|integer|min:1',
            'ubicacion' => 'required|in:Av. 6 de agosto,Plaza',
            'turno' => 'required|in:mañana,tarde,noche,amanecer',
            'contador_id' => 'required|exists:users,id',
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
