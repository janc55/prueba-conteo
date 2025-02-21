<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // 📌 Registro de usuario
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'rol' => 'in:contador,admin' // Opcional: por defecto será "contador"
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol ?? 'contador',
        ]);

        return response()->json([
            'message' => 'Usuario registrado con éxito',
            'token' => $user->createToken('API Token')->plainTextToken,
            'user' => $user
        ], 201);
    }

    // 📌 Inicio de sesión
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (!$user || !Hash::check($request->password, $user->password)) {
            Log::error("Error de login: Usuario no encontrado o contraseña incorrecta.", [
                'email' => $request->email
            ]);
    
            return response()->json([
                'message' => 'Las credenciales proporcionadas son incorrectas.'
            ], 401);
        }
    
        return response()->json([
            'message' => 'Inicio de sesión exitoso',
            'token' => $user->createToken('API Token')->plainTextToken,
            'user' => $user
        ], 200);
    }

    // 📌 Cerrar sesión
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Cierre de sesión exitoso'
        ], 200);
    }

    // 📌 Obtener usuario autenticado
    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}
