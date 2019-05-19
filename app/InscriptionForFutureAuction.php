<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InscriptionForFutureAuction extends Model
{
    protected $table = 'inscripciones_a_subastas_futuras';

    protected $fillable = [
        'usuario_id', 'subasta_id',
    ];

    public function auction(){
        return $this->belongsTo(Auction::class, 'subasta_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }

    public function property()
    {
        $auction = $this->auction;
        $property = $auction->property();
        return $property;
    }
}


