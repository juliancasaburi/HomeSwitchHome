<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Price extends Model
{
    protected $table = 'precios';

    protected $fillable = [
        'concepto', 'valor',
    ];

    static function price(string $concept){
        return DB::table('precios')->where('concepto', $concept)->pluck('valor')->first();
    }
}
