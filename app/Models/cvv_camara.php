<?php

namespace App\Models;
use App\Models\cvv_modelo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\database\Eloquent\Casts\Attribute;
class cvv_camara extends Model
{
    use HasFactory;
    public function modelo()
    {
        return $this->belongsTo(cvv_modelo::class, 'id_modelo');
    }

}
