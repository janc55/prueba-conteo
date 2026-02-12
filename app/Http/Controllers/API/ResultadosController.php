<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ConteoBanda;
use App\Models\Fraternidad;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ResultadosController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $gestionId = $request->gestion_id;

        // Obtener todas las fraternidades con sus conteos filtrados por gestión
        $fraternidades = Fraternidad::with([
            'conteos' => function ($q) use ($gestionId) {
                if ($gestionId) {
                    $q->where('gestion_id', $gestionId);
                } else {
                    $q->whereHas('gestion', function ($sq) {
                        $sq->where('activo', true); });
                }
            },
            'conteosBandas' => function ($q) use ($gestionId) {
                if ($gestionId) {
                    $q->where('gestion_id', $gestionId);
                } else {
                    $q->whereHas('gestion', function ($sq) {
                        $sq->where('activo', true); });
                }
            }
        ])->get();

        // Array para almacenar los resultados
        $resultados = [];

        foreach ($fraternidades as $fraternidad) {
            // Calcular el promedio de integrantes de la fraternidad
            $promedioIntegrantesFraternidad = $fraternidad->conteos->avg('cantidad_integrantes') ?? 0;
            $totalVaronesFraternidad = $fraternidad->conteos->sum('varones');
            $totalMujeresFraternidad = $fraternidad->conteos->sum('mujeres');

            // Calcular el promedio de bloques de la fraternidad
            $promedioBloques = $fraternidad->conteos->avg('bloques') ?? 0;

            // Obtener las bandas de la fraternidad
            $bandas = [];
            $processedBandaIds = [];

            foreach ($fraternidad->conteosBandas as $conteoBanda) {
                if (in_array($conteoBanda->banda_id, $processedBandaIds))
                    continue;
                $processedBandaIds[] = $conteoBanda->banda_id;

                // Calcular el promedio de integrantes por banda en esta gestión
                $queryBanda = ConteoBanda::where('banda_id', $conteoBanda->banda_id)
                    ->where('fraternidad_id', $fraternidad->id);

                if ($gestionId) {
                    $queryBanda->where('gestion_id', $gestionId);
                } else {
                    $queryBanda->whereHas('gestion', function ($sq) {
                        $sq->where('activo', true); });
                }

                $promedioIntegrantesBanda = $queryBanda->avg('cantidad_integrantes') ?? 0;
                $totalVaronesBanda = $queryBanda->sum('varones');
                $totalMujeresBanda = $queryBanda->sum('mujeres');

                $bandas[] = [
                    'banda_id' => $conteoBanda->banda_id,
                    'nombre_banda' => $conteoBanda->banda->nombre,
                    'promedio_integrantes' => round($promedioIntegrantesBanda),
                    'total_varones' => $totalVaronesBanda,
                    'total_mujeres' => $totalMujeresBanda,
                ];
            }

            // Contar cuántos conteos se han realizado para esta fraternidad
            $totalConteos = $fraternidad->conteos->count();

            // Obtener las ubicaciones únicas donde se realizaron los conteos
            $ubicaciones = $fraternidad->conteos->pluck('ubicacion')->unique()->values();

            // Agregar los resultados de esta fraternidad al array final
            $resultados[] = [
                'fraternidad_id' => $fraternidad->id,
                'nombre_fraternidad' => $fraternidad->nombre,
                'promedio_integrantes' => round($promedioIntegrantesFraternidad),
                'total_varones' => $totalVaronesFraternidad,
                'total_mujeres' => $totalMujeresFraternidad,
                'promedio_bloques' => round($promedioBloques, 2),
                'total_conteos' => $totalConteos,
                'ubicaciones' => $ubicaciones,
                'bandas' => $bandas,
                'total_bandas' => count($bandas),
            ];
        }

        // Devolver la respuesta en formato JSON
        return response()->json($resultados, 200);
    }
}
