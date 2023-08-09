<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class ConfirmacionController extends Controller
{
    public function confirmar($id, $token)
    {
        // Buscar el usuario por ID
        $user = User::find($id);

        // Verificar si el usuario existe y el token de verificación coincide
        if ($user && $user->verification_token === $token) {
            // Actualizar el estado de verificación del usuario
            $user->email_verified_at = now();
            $user->verification_token = null;
            $user->save();

            // Redirigir al usuario a la página de confirmación exitosa
            return redirect()->route('confirmacion.exitosa');
        }

        // Si el usuario no existe o el token no coincide, redirigir a una página de error
        return redirect()->route('confirmacion.error');
    }

    public function exitosa()
    {
        // Página de confirmación exitosa
        return redirect()->route('login');
    }

    public function error()
    {
        // Página de error de confirmación
        return view('registro.confirmacion_error');
    }
}