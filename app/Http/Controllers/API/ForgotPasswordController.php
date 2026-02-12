<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Resend\Laravel\Facades\Resend;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'No podemos encontrar un usuario con esa dirección de correo electrónico.'], 404);
        }

        $token = Str::random(64);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'email' => $request->email,
                'token' => Hash::make($token),
                'created_at' => now()
            ]
        );

        try {
            Resend::emails()->send([
                'from' => 'Carnaval App <onboarding@resend.dev>',
                'to' => [$request->email],
                'subject' => 'Restablecer contraseña',
                'html' => '<p>Has solicitado restablecer tu contraseña. Tu token de recuperación es:</p><h3>' . $token . '</h3><p>Si no solicitaste esto, ignora este mensaje.</p>',
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al enviar el correo electrónico.', 'error' => $e->getMessage()], 500);
        }

        return response()->json(['message' => 'Hemos enviado por correo electrónico su enlace de restablecimiento de contraseña.']);
    }

    public function reset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $record = DB::table('password_reset_tokens')->where('email', $request->email)->first();

        if (!$record || !Hash::check($request->token, $record->token)) {
            return response()->json(['message' => 'Token inválido o expirado.'], 400);
        }

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return response()->json(['message' => 'Tu contraseña ha sido restablecida.']);
    }
}
