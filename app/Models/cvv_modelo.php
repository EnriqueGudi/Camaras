<?php

namespace App\Models;
use App\Models\cvv_marca;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\database\Eloquent\Casts\Attribute;
class cvv_modelo extends Model
{
    use HasFactory;
    public function marca()
    {
        return $this->belongsTo(cvv_marca::class, 'id_marca');
    }

    public function camaras()
    {
        return $this->hasMany(cvv_camara::class);
    }
}

