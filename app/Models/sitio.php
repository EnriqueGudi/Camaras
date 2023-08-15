<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sitio extends Model
{
    use HasFactory;
    public function area()
    {
        return $this->belongsTo(cvv_marca::class, 'id_marca');
    }

    public function camaras()
    {
        return $this->hasMany(cvv_camara::class);
    }
}
