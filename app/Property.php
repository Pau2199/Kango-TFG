<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = 'property';
    protected $fillable = ['id', 'metros_cuadrados', 'precio', 'tipo_de_vivienda', 'descripcion', 'ascensor', 'garage', 'n_habitaciones', 'n_cuartos_de_banyo', 'idUsuario', 'disponible'];
    public $timestamps = false;
}
