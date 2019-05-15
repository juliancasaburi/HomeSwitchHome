<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InscriptionForFutureAuction extends Model
{
    protected $table = 'subastas';

    protected $fillable = [
        'usuario_id', 'subasta_id', 'inicio', 'fin',
    ];

    public function auction(){
        return $this->hasOne(Auction::class);
    }

    public function user(){
        return $this->hasOne(User::class);
    }
}


