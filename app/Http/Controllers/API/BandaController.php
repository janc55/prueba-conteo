<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Banda;
use App\Models\Fraternidad;
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
    
    public function asignarBandaFraternidad(Request $request)
    {
        $request->validate([
            'banda_id' => 'required|exists:bandas,id',
            'fraternidad_id' => 'required|exists:fraternidades,id',
            'cantidad_integrantes' => 'required|integer',
        ]);

        $fraternidad = Fraternidad::find($request->fraternidad_id);
        $fraternidad->bandas()->attach($request->banda_id, ['cantidad_integrantes' => $request->cantidad_integrantes]);

        return response()->json(['message' => 'Banda asignada a fraternidad correctamente'], 201);
    }
}
