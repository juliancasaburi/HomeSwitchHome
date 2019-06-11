<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

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

    public function uniqueBidders(int $auctionID){
        return DB::table('pujas')->where('subasta_id', '=', $auctionID)->distinct()->count('usuario_id');
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
}

