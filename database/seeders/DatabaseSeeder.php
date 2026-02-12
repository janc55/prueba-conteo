<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ejecutar el seeder de Fraternidades
        $this->call(FraternidadesSeeder::class);

        // Ejecutar el seeder del Usuario Admin
        $this->call(AdminUserSeeder::class);

        $this->call(BandasSeeder::class);
    }
}
