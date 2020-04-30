<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $table = 'rental';
    protected $fillable = ['id', 'internet', 'animales', 'reformas', 'calefaccion', 'aireAcondicionado', 'fianza', 'idInmueble'];
    public $timestamps = false;
}
