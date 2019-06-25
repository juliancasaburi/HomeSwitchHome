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
        return $this->belongsTo(Property::class, 'propiedad_id', 'id')->withTrashed();
    }

    public function auction(){
        return $this->hasOne(Auction::class, 'semana_id', 'id')->withTrashed();
    }

    public function reservation(){
        return $this->hasOne(Reservation::class, 'semana_id', 'id');
    }

    public function allReservations(){
        return $this->hasMany(Reservation::class, 'semana_id', 'id')->withTrashed();
    }

    public function sendBookedByAPremiumUserNotifications(){
        $inscriptions = $this->auction->inscriptions()->get();
        foreach($inscriptions as $i){
            $i->user->sendBookedByAPremiumUserNotification($this->property->nombre, $this->fecha, $this->id);
        }
    }

    public function bookTo(User $user){
        $reservation = new Reservation();
        $reservation->semana_id = $this->id;
        $reservation->usuario_id = $user->id;
        $reservation->valor_reservado = null;
        $reservation->modo_reserva = 1;
        $reservation->save();

        $user->creditos -= 1;
        $user->save();

        $this->auction()->delete();
        $this->delete();

        $user->sendReservationObtainedNotification($this->property->nombre, $this->fecha);
        $this->sendBookedByAPremiumUserNotifications();
    }

    public function sendAuctionCancelledNotifications(){
        $inscriptions = $this->auction->inscriptions()->get();
        foreach($inscriptions as $i){
            $i->user->sendAuctionCancelledNotification($this->property->nombre, $this->fecha, $this->auction->id);
        }
    }
}
