<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Banda;
use Illuminate\Http\Request;

class BandaController extends Controller
{
    public function index()
    {
        return response()->json(Banda::with('fraternidades')->get(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|unique:bandas',
            'cantidad_integrantes' => 'integer|min:0',
        ]);

        $banda = Banda::create($request->all());
        return response()->json($banda, 201);
    }

    public function show($id)
    {
        $banda = Banda::with('fraternidades')->find($id);
        if (!$banda) {
            return response()->json(['error' => 'Banda no encontrada'], 404);
        }
        return response()->json($banda, 200);
    }

    public function update(Request $request, $id)
    {
        $banda = Banda::find($id);
        if (!$banda) {
            return response()->json(['error' => 'Banda no encontrada'], 404);
        }

        $request->validate([
            'nombre' => 'string|unique:bandas,nombre,' . $id,
            'cantidad_integrantes' => 'integer|min:0',
        ]);

        $banda->update($request->all());
        return response()->json($banda, 200);
    }

    public function destroy($id)
    {
        $banda = Banda::find($id);
        if (!$banda) {
            return response()->json(['error' => 'Banda no encontrada'], 404);
        }
        
        $banda->delete();
        return response()->json(['message' => 'Banda eliminada'], 200);
    }
}
