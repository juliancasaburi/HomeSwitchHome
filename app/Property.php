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
        'nombre', 'pais', 'provincia', 'ciudad', 'calle', 'precio', 'estrellas', 'capacidad', 'habitaciones', 'baños', 'garages',
    ];
}

