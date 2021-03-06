<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'semana_id', 'usuario_id', 'valor_reservado', 'modo_reserva',
    ];

    protected $table = 'reservas';

    public function week(){
        return $this->belongsTo(Week::class, 'semana_id', 'id')->withTrashed();
    }

    public function user(){
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }

    public function cancel(){
        $this->user->sendReservationCancelledNotification($this->week->property->nombre, $this->week->fecha, $this->valor_reservado);
        $this->week->restore();
        $this->delete();
    }

    public function property()
    {
        $week = $this->week;
        return $week->property();
    }
}
