<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Week extends Model
{
    use SoftDeletes;

    protected $table = 'semanas';

    protected $fillable = [
        'propiedad_id', 'fecha',
    ];

    public function property(){
        return $this->belongsTo(Property::class, 'propiedad_id', 'id');
    }

    public function auction(){
        return $this->hasOne(Auction::class, 'semana_id', 'id')->withTrashed();
    }

    public function reservation(){
        return $this->hasOne(Reservation::class, 'semana_id', 'id');
    }

    public function inscriptions(){
        return $this->hasManyThrough(InscriptionForFutureAuction::class, Auction::class, 'semana_id', 'usuario_id', 'id', 'id');
    }
}
