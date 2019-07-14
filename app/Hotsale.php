<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Hotsale extends Model
{
    use SoftDeletes;

    protected $table = 'hotsales';

    protected $fillable = [
        'semana_id', 'precio', 'fecha_inicio', 'fecha_fin',
    ];

    public function week(){
        return $this->belongsTo(Week::class, 'semana_id', 'id')->withTrashed();
    }

    /**
     * Scope a query to only include to be closed hotsales.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeToBeClosed($query)
    {
        return $query->where('fin', '<=', Carbon::now());
    }
}
