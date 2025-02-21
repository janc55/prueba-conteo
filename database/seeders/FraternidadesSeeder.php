<?php

namespace Database\Seeders;

use App\Models\Fraternidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FraternidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $conjuntos = [
            // 🔹 Grupo 1
            ['grupo' => 1, 'nombre' => 'GRAN TRAO. AUTENTICA DIABLADA ORURO', 'tipo_danza' => 'Diablada'],
            ['grupo' => 1, 'nombre' => 'FRAT. HIJOS DEL SOL “LOS INCAS”', 'tipo_danza' => 'Danza Autóctona'],
            ['grupo' => 1, 'nombre' => 'CONJ. FOLK. MORENADA ZONA NORTE', 'tipo_danza' => 'Morenada'],
            ['grupo' => 1, 'nombre' => 'FRAT. ART. ZAMPOÑEROS HIJOS DEL PAGADOR', 'tipo_danza' => 'Zampoñeros'],
            ['grupo' => 1, 'nombre' => 'CENTRO TRAO. NEGRITOS DE PAGADOR', 'tipo_danza' => 'Negritos'],
            ['grupo' => 1, 'nombre' => 'CONJ. FOLK. AHUATIRIS', 'tipo_danza' => 'Danza Autóctona'],
            ['grupo' => 1, 'nombre' => 'CONJ. WACA WACAS "SAN AGUSTÍN" (DERECHO)', 'tipo_danza' => 'Waca Wacas'],
            ['grupo' => 1, 'nombre' => 'FRAT. MORENADA CENTRAL ORURO', 'tipo_danza' => 'Morenada'],
            ['grupo' => 1, 'nombre' => 'CONJ. CAPORALES INFANTILES IGNACIO LEÓN', 'tipo_danza' => 'Caporales'],

            // 🔹 Grupo 2
            ['grupo' => 2, 'nombre' => 'CONJ. TRAO. FOLK. DIABLADA ORURO', 'tipo_danza' => 'Diablada'],
            ['grupo' => 2, 'nombre' => 'FRAT. CAPORALES CENTRALISTAS', 'tipo_danza' => 'Caporales'],
            ['grupo' => 2, 'nombre' => 'FRAT. MORENADA CENTRAL ORURO Fund. por la Com. Cocani', 'tipo_danza' => 'Morenada'],
            ['grupo' => 2, 'nombre' => 'CONJ. FOLK. TOBAS ZONA SUR', 'tipo_danza' => 'Tobas'],
            ['grupo' => 2, 'nombre' => 'CONJ. NEGRITOS UNIDOS DE LA SAYA', 'tipo_danza' => 'Saya'],
            ['grupo' => 2, 'nombre' => 'CONJ. WACA TOKORIS URUS', 'tipo_danza' => 'Waca Wacas'],
            ['grupo' => 2, 'nombre' => 'CONJ. FOLK. ANTAWARA', 'tipo_danza' => 'Danza Autóctona'],
            ['grupo' => 2, 'nombre' => 'CONJ. FOLK. TINKUS TOLKAS', 'tipo_danza' => 'Tinkus'],

            // 🔹 Grupo 3
            ['grupo' => 3, 'nombre' => 'FRAT. ART. Y CULT. LA DIABLADA', 'tipo_danza' => 'Diablada'],
            ['grupo' => 3, 'nombre' => 'CONJ. MORENADA MEJILLONES', 'tipo_danza' => 'Morenada'],
            ['grupo' => 3, 'nombre' => 'FRAT. FOLK. LLAMERADA SOCAVÓN', 'tipo_danza' => 'Llamerada'],
            ['grupo' => 3, 'nombre' => 'CONJ. FOLK. Y CULT. PHUJLLAY ORURO', 'tipo_danza' => 'Danza Autóctona'],
            ['grupo' => 3, 'nombre' => 'GRUPO DE DANZA EST. SURI SICURI', 'tipo_danza' => 'Suri Sicuri'],
            ['grupo' => 3, 'nombre' => 'CONJ. FOLK. SAMBOS CAPORALES', 'tipo_danza' => 'Caporales'],
            ['grupo' => 3, 'nombre' => 'FRAT. CULLAGUADA ORURO', 'tipo_danza' => 'Cullaguada'],
            ['grupo' => 3, 'nombre' => 'CONJ. TRAO. TOBAS ZONA CENTRAL', 'tipo_danza' => 'Tobas'],
            ['grupo' => 3, 'nombre' => 'CONJ. FOLK. DE ZAMPONEROS KORY MAITAS', 'tipo_danza' => 'Zampoñeros'],

            // 🔹 Grupo 4
            ['grupo' => 4, 'nombre' => 'CONJ. DIABLADA FERROVARIA', 'tipo_danza' => 'Diablada'],
            ['grupo' => 4, 'nombre' => 'FRAT. REYES MORENOS “FERRARI GHEZZI”', 'tipo_danza' => 'Morenada'],
            ['grupo' => 4, 'nombre' => 'CAPORALES REYES DE LA TUNTURA “ENAF”', 'tipo_danza' => 'Caporales'],
            ['grupo' => 4, 'nombre' => 'CONJ. TINKUS “LOS JAIRAS DE ORURO”', 'tipo_danza' => 'Tinkus'],
            ['grupo' => 4, 'nombre' => 'FRAT. "CULLAGUADA TERRIBLES QUIRQUINCHOS"', 'tipo_danza' => 'Cullaguada'],
            ['grupo' => 4, 'nombre' => 'FRAT. “KALLAWAYAS BOLIVIA’”', 'tipo_danza' => 'Kallawaya'],
            ['grupo' => 4, 'nombre' => 'CONJ. “POTOLOS CHAYANTAS JHILANCOS”', 'tipo_danza' => 'Potolos'],
            ['grupo' => 4, 'nombre' => 'CONJ. FOLK. Y CULTURAL “DOCTORCITOS ITOS”', 'tipo_danza' => 'Doctorcitos'],
            ['grupo' => 4, 'nombre' => 'FRAT. DE DANZA EST. “INTILLAJTA”', 'tipo_danza' => 'Danza Autóctona'],

            // 🔹 Grupo 5
            ['grupo' => 5, 'nombre' => 'DIABLADA ART. L’URUS”', 'tipo_danza' => 'Diablada'],
            ['grupo' => 5, 'nombre' => 'FRAT. CULT. REYES MORENOS “COMIBOL”', 'tipo_danza' => 'Morenada'],
            ['grupo' => 5, 'nombre' => 'CONJ. ART. Y CULT. “TOBAS URU-URU”', 'tipo_danza' => 'Tobas'],
            ['grupo' => 5, 'nombre' => 'FRAT. FOLK. CULT. CAPORALES UNIV. “SAN SIMÓN”', 'tipo_danza' => 'Caporales'],
            ['grupo' => 5, 'nombre' => 'CONJ. AUTOCTONO “WITITIS”', 'tipo_danza' => 'Wititis'],
            ['grupo' => 5, 'nombre' => 'CONJ. FOLK. “TINKUS HUAJCHAS”', 'tipo_danza' => 'Tinkus'],
            ['grupo' => 5, 'nombre' => 'INCAS KOLLASUYO “HIJOS DEL SOCAVÓN”', 'tipo_danza' => 'Incas'],
            ['grupo' => 5, 'nombre' => 'TARQUEADA “JATUN JALLPA”', 'tipo_danza' => 'Tarqueada'],

            // 🔹 Grupo 6
            ['grupo' => 6, 'nombre' => 'FRAT. MORENADA METALÚRGICA “ENAF”', 'tipo_danza' => 'Morenada'],
            ['grupo' => 6, 'nombre' => 'CENTRO CULTURAL “RIJCHARY LLAJTA”', 'tipo_danza' => 'Danza Autóctona'],
            ['grupo' => 6, 'nombre' => 'CONJ. UNIV. “SURI UTO”', 'tipo_danza' => 'Suri Sicuri'],
            ['grupo' => 6, 'nombre' => 'CONJ. “KANTUS SARTAÑANI”', 'tipo_danza' => 'Kantus'],
            ['grupo' => 6, 'nombre' => 'FRAT. CAPORALES “CBN”', 'tipo_danza' => 'Caporales'],
            ['grupo' => 6, 'nombre' => 'CONJ. AUTOCTONO “SUMAJ PUNCHAY”', 'tipo_danza' => 'Danza Autóctona'],
            ['grupo' => 6, 'nombre' => 'FRAT. FOLK. ART. CULT. “PULLLAY”', 'tipo_danza' => 'Danza Autóctona'],
            ['grupo' => 6, 'nombre' => 'CONJ. TRAD. “LLAMERADA ZONA NORTE”', 'tipo_danza' => 'Llamerada'],
            ['grupo' => 6, 'nombre' => 'FRAT. CULT. TINKUS “BOLIVIA” (Ayllu Lajwas)', 'tipo_danza' => 'Tinkus'],
        ];

        // Insertar los datos en la base de datos
        foreach ($conjuntos as $conjunto) {
            Fraternidad::create($conjunto);
        }

        echo "✅ Fraternidades insertadas correctamente.\n";
    }
}
