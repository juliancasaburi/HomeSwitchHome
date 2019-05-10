<?php

namespace App;

class Property extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'pais', 'provincia', 'localidad', 'calle', 'numero', 'precio', 'estrellas', 'capacidad', 'habitaciones', 'baños', 'garages',
    ];
}

