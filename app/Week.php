<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
    protected $table = 'semanas';

    protected $fillable = [
        'propiedad_id', 'fecha', 'precio'
    ];

    public function property(){
        return $this->belongsTo(Property::class);
    }
}
