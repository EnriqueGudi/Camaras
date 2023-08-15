<?php

use App\Http\Controllers\InsertController;
use App\Http\Controllers\DeleteController;
use App\Http\Controllers\CamaraController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ConfirmacionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('index');


    Route::get('/camaras', [CamaraController::class, 'index']);

    Route::post('InsertController/camaras', [InsertController::class, 'setCamara'])->name('insert.camara');
    Route::post('DeleteController/camaras', [DeleteController::class, 'delCamara'])->name('delete.camara');

    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/')->with('message', '¡Has cerrado sesión exitosamente!');
    })->name('logout');
    // Ruta para cerrar sesión

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});

Route::middleware('guest')->group(function () {
    // Rutas de registro
    Route::get('/registro_usuario', [RegisterController::class, 'index'])->name('registro_usuario');
    Route::post('/registro_usuario', [RegisterController::class, 'register'])->name('registro');

    // Rutas de confirmación
    Route::get('/confirmacion/{id}/{token}', [ConfirmacionController::class, 'confirmar'])->name('confirmacion');
    Route::get('/confirmacion/error', [ConfirmacionController::class, 'error'])->name('confirmacion.error');
    Route::get('/confirmacion/exitosa', [ConfirmacionController::class, 'exitosa'])->name('confirmacion.exitosa');

    // Ruta de inicio de sesión - Vista
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    // Ruta de inicio de sesión - Procesamiento
    Route::post('/login', [AuthController::class, 'login']);
});