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

    public function user(){
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }
}
