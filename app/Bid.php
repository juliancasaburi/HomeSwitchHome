<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $table = 'pujas';

    protected $fillable = [
        'usuario_id', 'subasta_id', 'monto',
    ];
}
