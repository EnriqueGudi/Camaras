<?php

namespace App\Http\Controllers;
use App\Models\cvv_camara;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeleteController extends Controller
{
    public function delCamara(Request $request)
    {
        $no_serie = $request->input('no_serie');

        // Busca la cámara por el número de serie y elimínala si existe
        $camara = cvv_camara::where('no_serie', $no_serie)->first();
    
        if ($camara) {
            $fileName = strrchr($camara->foto_cam, '/');

            $fileName = substr($fileName, 1);

            $file_path="public/imagenes_camaras/".$fileName;

            if (Storage::exists($file_path)) {
                if (Storage::delete($file_path)) {
                    // Imagen eliminada exitosamente
                } else {
                    return response()->json(['message' => 'Error al eliminar la imagen',
                                             'type'  => 'warning'
                    ]);
                }
            } else {
                return response()->json(['message' => 'La imagen no existe',
                                         'type'  => 'warning'
                ]);
            }
            $camara->delete();
            return response()->json(['type' => 'success', 
                                     'message' => 'Camara eliminada exitosamente',
            ]);
        } else {
            return response()->json(['type' => 'error', 
                                     'message' => 'Camara no encontrada',
           ]);
        }

    }
}
