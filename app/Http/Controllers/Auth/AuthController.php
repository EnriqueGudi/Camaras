<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('/login');
    }

    /**
     * Handle the login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Comprueba si el correo está verificado
            if (Auth::user()->email_verified_at !== null) {
                // Authentication passed
                $request->session()->regenerate();
    
                return response()->json([
                    'type' => 'success',
                    'redirect' => url('/'), // Devuelve la URL de redirección
                ]);
            } else {
                // El correo no está verificado
                Auth::logout();
    
                return response()->json([
                    'type' => 'warning',
                    'message' => 'El correo no está verificado. Por favor, verifica tu correo electrónico.',
                ]);
            }
        }else{
            return response()->json([
                'type' => 'warning',
                'message' => 'Correo o contraseña incorrecto',
            ]);
        }
    }

    /**
     * Handle the logout request.
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
