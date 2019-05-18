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
        return $this->belongsTo(Week::class, 'semana_id', 'id');
    }

    public function inscriptions(){
        return $this->hasMany(InscriptionForFutureAuction::class, 'subasta_id', 'id');
    }

    public function propertyName(){
        $week = $this->week;
        $property = $week->property;
        return $property->nombre;
    }
}

