<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $table = 'precios';

    protected $fillable = [
        'concepto', 'valor',
    ];
}
