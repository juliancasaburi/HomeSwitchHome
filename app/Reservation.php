<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'valor_reservado', 'modo_reserva',
    ];

    protected $table = 'reservas';

    public function week(){
        return $this->hasOne(Week::class, 'propiedad_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
