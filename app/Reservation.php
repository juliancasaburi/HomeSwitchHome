<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'usuario_id', 'valor_reservado', 'fecha', 'modo_reserva',
    ];

    protected $table = 'reservas';

    public function week(){
        return $this->belongsTo(Week::class, 'semana_id', 'id')->withTrashed();
    }

    public function user(){
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }
}
