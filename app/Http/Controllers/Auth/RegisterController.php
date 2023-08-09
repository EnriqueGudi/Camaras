<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ConfirmacionRegistro; // Importa la clase del correo de confirmación

use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        return view('registro.registro_usu');
    }

    public function register(Request $request)
    {
        try {
            // Validar los datos de entrada
            $this->validate($request, [
                'nombre' => 'required',
                'correo' => 'required|email|unique:users,email',
                'contraseña' => 'required|min:6|confirmed',
                'contraseña_confirmation' => 'required|min:6',
            ]);
        } catch (ValidationException $e) {
            // Si la validación falla, devuelve una respuesta JSON con los errores
            return response()->json([
                'type' => 'warning',
                'message' => $e->validator->errors()->first(),
            ]);
        }

        $token = Str::random(40);

        // Verificar si el token ya existe en la base de datos
        while (User::where('verification_token', $token)->exists()) {
            $token = Str::random(40); // Generar un nuevo token si ya existe
        }
        // Crear el nuevo usuario
        try {
            $user = new User();
            $user->name = $request->input('nombre');
            $user->email = $request->input('correo');
            $user->password = Hash::make($request->input('contraseña'));
            $user->verification_token = $token;
            $user->save();
            Mail::to($user->email)->send(new ConfirmacionRegistro($user));
        } catch (\Exception $e) {

            $user->delete();

            return response()->json([
                'type' => 'warning',
                'message' => "No se pudo enviar el correo de verificación, por favor intente más tarde", 
            ]);
        } 
  
        return response()->json([
            'type' => 'success',
            'redirect' => url('/login'), 
        ]);
    }
}

