<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moto extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category',
        'starting_price',
        'highest_bid', 
        'ending_date'
    ];

    protected $table = 'motos';


    protected $first_image_url; 


    //Metodo para vincular varias imagenes a una moto
    //1º parametro -> La otra clase
    //2º paramtetro -> la lcave foranea de la tabla imagenes que se vincula con moto
    //3º paramtetro -> la clave principal de la tabla moto
    public function images()
    {
        return $this->hasMany(Image::class, 'moto_id', 'id');
    }

    public function bids()
    {
        return $this->hasMany(Bid::class, 'moto_id', 'id');
    }

}
