<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PremiumRequest extends Model
{

    protected $table = 'solicitudes_premium';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usuario_id',
    ];
}
