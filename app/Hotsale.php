<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotsale extends Model
{
    use SoftDeletes;

    protected $table = 'hotsales';

    protected $fillable = [
        'semana_id', 'precio', 'fecha_inicio', 'fecha_fin',
    ];

    public function week(){
        return $this->hasOne(Week::class, 'semana_id', 'id');
    }
}
