<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'moto_images';

    protected $fillable = ['moto_id', 'url_image'];

    //Metodo de una imagen solo una moto
    //mismo orden de parámetros, primero la clave de image que referenia a moto, y luego la clave principal de la tabla moto
    public function moto()
    {
        return $this->belongsTo(Moto::class, 'moto_id', 'id');
    }
}
