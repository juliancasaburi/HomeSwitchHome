<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
    protected $table = 'semanas';

    protected $fillable = [
        'propiedad_id', 'fecha',
    ];

    public function property(){
        return $this->belongsTo(Property::class, 'propiedad_id', 'id');
    }

    public function auction(){
        return $this->hasOne(Auction::class, 'semana_id', 'id');
    }

    public function reservation(){
        return $this->belongsTo(Reservation::class);
    }
}
