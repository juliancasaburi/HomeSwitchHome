<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\Notifications\ReservationObtained;

class Auction extends Model
{
    use SoftDeletes;

    protected $table = 'subastas';

    protected $fillable = [
        'semana_id', 'precio_inicial', 'inscripcion_inicio', 'inscripcion_fin', 'inicio', 'fin', 'notificaciones_enviadas',
    ];

    public function week(){
        return $this->belongsTo(Week::class, 'semana_id', 'id')->withTrashed();
    }

    public function inscriptions(){
        return $this->hasMany(InscriptionForFutureAuction::class, 'subasta_id', 'id');
    }

    public function property(){
        $week = $this->week;
        return $week->property();
    }

    public function bids(){
        return $this->hasMany(Bid::class, 'subasta_id', 'id');
    }

    public function latestBid(){
        return $this->hasOne(Bid::class, 'subasta_id', 'id')->latest();
    }

    public function latestBidForUser(User $user){
        return $this->hasMany(Bid::class, 'subasta_id', 'id')->where('usuario_id', $user->id)->latest();
    }

    public function uniqueBidders(int $thisuctionID){
        return DB::table('pujas')->where('subasta_id', '=', $thisuctionID)->distinct()->count('usuario_id');
    }

    public function propertyName(){
        $week = $this->week;
        $property = $week->property;
        return $property->nombre;
    }

    /**
     * Scope a query to only include auctions awaiting bidding period.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePending($query)
    {
        return $query->where('inscripcion_inicio', '>', Carbon::now());
    }

    /**
     * Scope a query to only include auctions awaiting inscription period.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAwaitingInscriptionPeriod($query)
    {
        return $query->where('inscripcion_inicio', '<=', Carbon::now())
            ->where('inscripcion_fin', '>', Carbon::now());
    }

    /**
     * Scope a query to only include active auctions.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('inicio', '<=', Carbon::now())
            ->where('fin', '>', Carbon::now());
    }

    public function sendAuctionStartedNotifications(){
        $inscriptions = $this->inscriptions;
        foreach($inscriptions as $i){
            $i->user->sendAuctionStartedNotification($this->property->nombre, $this->week->fecha, $this->id);
        }
        $this->notificaciones_enviadas = Carbon::now();
        $this->save();
    }

    public function wasCancelled(){
        return ($this->trashed() && ($this->deleted_at < $this->fin));
    }

    public function hasFinished(){
        return ($this->trashed());
    }

    public function isDeletable(){
        return ($this->inicio > Carbon::now() && $this->deleted_at == null);
    }

    public function sendAuctionCancelledNotifications(){
        $inscriptions = $this->inscriptions()->get();
        foreach($inscriptions as $i){
            $i->user->sendAuctionCancelledNotification($this->property->nombre, $this->week->fecha, $this->id);
        }
    }

    public function isInAuctionPeriod(){
        return ($this->inicio <= Carbon::now() && $this->fin >= Carbon::now() && $this->deleted_at == null);
    }

    /**
     * Scope a query to only include to be closed auctions.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeToBeClosed($query)
    {
        return $query->where('fin', '<=', Carbon::now());
    }
    
    public function close(){
        if (!DB::table('pujas')->where('subasta_id', $this->id)->get()->isEmpty()) {
            $winnerBid = Bid::where('subasta_id', $this->id)->latest()->first();
            $winnerUser = $winnerBid->user;
            while ((($winnerUser->creditos == 0) || ($winnerUser->saldo < $winnerBid->monto)) && (DB::table('pujas')->where('subasta_id', $this->id)->where('id', '<>', $winnerBid->id)->get()->count() > 0)) {
                $winnerBid = Bid::where('subasta_id', $this->id)->where('id', '<>', $winnerBid->id)->latest()->first();
                $winnerUser = $winnerBid->user;
            }
            if (($winnerUser->creditos > 0) && ($winnerUser->saldo >= $winnerBid->monto)) {
                $reservation = new Reservation();
                $reservation->usuario_id = $winnerUser->id;
                $reservation->valor_reservado = $winnerBid->monto;
                $reservation->semana_id = $this->week->id;
                $reservation->modo_reserva = 0;
                $reservation->save();
                $winnerUser->creditos -= 1;
                $winnerUser->saldo -= $winnerBid->monto;
                $winnerUser->save();
                $winnerUser->notify(new ReservationObtained($this->week->property->nombre, $this->week->fecha));
            }
        }
        $this->delete();
        $this->week->delete();
    }
}

