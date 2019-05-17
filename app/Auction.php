<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $table = 'subastas';

    protected $fillable = [
        'semana_id', 'precio_inicial', 'inscripcion_inicio', 'inscripcion_fin', 'inicio', 'fin',
    ];

    public function week(){
        return $this->hasOne(Week::class, 'id', 'semana_id');
    }

    public function propertyName(){
        $week = $this->week();
        $property = $week->property();
        return $property->nombre;
    }
}

