<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'josenegretti55@gmail.com'], // Verifica si el usuario ya existe
            [
                'name' => 'janc55',
                'email' => 'josenegretti55@gmail.com',
                'password' => Hash::make('12345678'), // 🔒 Encriptamos la contraseña
                'rol' => 'admin' // Asignamos el rol de administrador
            ]
        );

        echo "Usuario administrador creado con éxito.\n";
    }
}
