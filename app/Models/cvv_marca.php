<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\database\Eloquent\Casts\Attribute;
class cvv_marca extends Model
{
    use HasFactory;
    public function modelos()
    {
        return $this->hasMany(cvv_modelo::class);
    }
}
