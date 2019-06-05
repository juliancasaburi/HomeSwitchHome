<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $table = 'tarjetas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usuario_id', 'numero', 'marca', 'nombre_titular', 'fecha_vencimiento', 'codigo_verificacion',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }
}
