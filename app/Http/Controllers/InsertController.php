<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\cvv_camara;  
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class InsertController extends Controller
{
    public function setCamara(Request $request)
    {
        // Obtener los datos enviados desde la petición POST
        $datos = $request->all();
    
        try{
            $request->validate([
                'cam_no_serie' => [
                    'required',
                    Rule::unique('cvv_camaras', 'no_serie'),
                ],
                'cam_mac' => [
                    'required',
                    Rule::unique('cvv_camaras', 'dir_mac'),
                ],
                'foto_ubi_cam' => [
                    'required',
                    'image', // Verifica que sea una imagen válida (jpg, png, gif, etc.).
                    'mimes:jpeg,png',
                    'max:5120', // Tamaño máximo en kilobytes (5MB = 5 * 1024 KB).
                ],


                // Otras reglas de validación para los demás campos
            ]);
        }catch (\Illuminate\Validation\ValidationException $e) {
            // Si ocurre una excepción de validación, puedes devolver una respuesta JSON de error
            return response()->json([
                'type' => 'warning',
                'message' => 'Camara no insertada',
            ]);
        }

        // Crear transaccion para evitar el registro si no se puede subir la imagen
        try{
            DB::beginTransaction();
            // Crear una nueva instancia del modelo cvv_camara
            $camara = new cvv_camara();
            $camara->no_serie = $datos['cam_no_serie'];
            $camara->estatus = "disponible";
            $camara->foto_cam = "";
            $camara->fecha_disp = now();
            $camara->dir_mac = $datos['cam_mac'];
            $camara->nombre_cam = $datos['cam_name'];
            $camara->id_modelo = $datos['cam_modelo']; 
            
            // Guardar la nueva instancia en la base de datos
            $camara->save();

            // Obtener el ID de la cámara recién guardada
            $idCamara = $camara->id;

            // Guardar la imagen subida en el almacenamiento con el nombre "camara_" + id de la cámara + extensión del archivo
            $imagenPath = $request->file('foto_ubi_cam')->storeAs('imagenes_camaras', 'camara_'.$idCamara.'.'.$request->file('foto_ubi_cam')->extension(), 'public');

            // Obtener la URL de la imagen almacenada
            $imagenUrl = Storage::url($imagenPath);

            // Actualizar el campo de la imagen URL en la base de datos
            $camara->foto_cam = $imagenUrl;
            $camara->save();
            DB::commit();
        }catch(\Illuminate\Validation\ValidationException $e){

            DB::rollback();
            return response()->json(['type' => 'error', 
            'message' => 'Hubo algún error',
           ]);
        }
        // Recuperar la instancia guardada con los datos de sus tablas secundarias
        $ultimaCamara = cvv_camara::with('modelo','modelo.marca')->latest()->first();  
        // Retornar la respuesta con los valores necesarios para pintar en la tabla
        return response()->json(['type' => 'success', 
                                 'message' => 'Camara insertada correctamente',
                                 'no_serie' => $ultimaCamara['no_serie'],
                                 'marca' => $ultimaCamara['modelo']['marca']['nombre_marca'],
                                 'estatus' => $ultimaCamara['estatus'],
                                 'foto_cam'=>$imagenUrl
                                ]);
    }
    
}
