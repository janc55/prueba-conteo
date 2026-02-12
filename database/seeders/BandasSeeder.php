<?php

namespace Database\Seeders;

use App\Models\Banda;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BandasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bandas = [
            ['nombre' => 'BANDA ESPECTACULAR BOLIVIA', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA ESPECTACULAR PAGADOR', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA SUPER CENTRAL', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA UNION PAGADOR', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA ORQUESTA PROYECCIÓN ORURO', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA ORQUESTA GRAN SONORA BRASS', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA INTERGALACTICA INTERCONTINENTAL POOPO', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA FEMENINA CANDELARIA', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA CENTRAL COCANI', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA REAL IMPERIAL SIN RIVAL', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA 10 DE FEBRERO MUNDIAL', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA POTENCIA MUSICAL', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA ARMONIA MUSICAL', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA SUPER IMPERIAL', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA ESPECTACULAR POOPO', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA ESPECTACULAR SIN PAR BOLIVAR', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA REAL EXPRESIÓN', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA KOLLASUYO ORURO', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA REAL POOPO', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA TRUENOS BOLIVIA', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA INTERCONTINENTAL POOPO', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA REBELDES', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA LOS DECADENTES', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA SUPER CONTINENTAL 100%', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA LOS ANDES', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA SUCRE', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA JUVENTUD SAN JOSÉ', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA IMPECABLES', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA ORQUESTA FATAL ORURO', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA UNION CONTINENTAL 100%', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA MI SARACHO', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA FABULOSA GRAN POOPO', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA SUPER CONTINENTES', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA TRIUNFAL', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA HUARI', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA UNION IMPERIAL', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA HUANUNI', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA SIN COMENTARIOS', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA REAL IMPERIAL ORIGINAL', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA SUPER MAJESTAD', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA INTERCONTINENTAL 15 DE AGOSTO', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA NUEVA ALIANZA', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA AMERICA', 'cantidad_integrantes' => 0],
            ['nombre' => 'BANDA UNION LIBERTAD', 'cantidad_integrantes' => 0],
        ];
        
        
        // Insertar los datos en la base de datos
        foreach ($bandas as $banda) {
            Banda::create($banda);
        }

        echo "✅ Bandas insertadas correctamente.\n";
    }
}
