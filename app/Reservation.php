<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use SoftDeletes;

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

    public function cancel(){
        $this->user->sendReservationCancelledNotification($this->week->property->nombre, $this->week->fecha, $this->valor_reservado);
        $this->user->creditos += 1;
        $this->user->saldo += $this->valor_reservado;
        $this->user->save();
        $this->delete();
    }
}
