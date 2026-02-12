<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Gestion;
use Illuminate\Http\Request;

class GestionController extends Controller
{
    public function index()
    {
        return Gestion::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|unique:gestiones',
            'anio' => 'required|integer',
            'activo' => 'required|boolean'
        ]);

        if ($request->activo) {
            Gestion::where('activo', true)->update(['activo' => false]);
        }

        $gestion = Gestion::create($request->all());
        return response()->json($gestion, 201);
    }

    public function update(Request $request, Gestion $gestion)
    {
        $request->validate([
            'nombre' => 'string|unique:gestiones,nombre,' . $gestion->id,
            'anio' => 'integer',
            'activo' => 'boolean'
        ]);

        if ($request->activo) {
            Gestion::where('activo', true)->update(['activo' => false]);
        }

        $gestion->update($request->all());
        return response()->json($gestion);
    }

    public function destroy(Gestion $gestion)
    {
        $gestion->delete();
        return response()->json(['message' => 'Gestión eliminada'], 200);
    }
}
