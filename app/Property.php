<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Property extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'pais', 'provincia', 'localidad', 'calle', 'numero', 'estrellas', 'capacidad', 'habitaciones', 'baños', 'capacidad_vehiculos',
    ];

    protected $table = 'propiedades';
    
    public function getImageAttribute()
    {
        return $this->image_path;
    }

    public function weeks(){
        return $this->hasMany(Week::class, "propiedad_id", "id")->withTrashed();
    }

    public function activeWeeks(){
        return $this->hasMany(Week::class, "propiedad_id", "id");
    }
}

