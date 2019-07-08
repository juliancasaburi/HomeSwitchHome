<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'usuario_id', 'propiedad_id', 'parent_id', 'texto',
    ];

    protected $table = 'comentarios';

    public function user(){
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }

    public function property(){
        return $this->belongsTo(Property::class, 'propiedad_id', 'id')->withTrashed();
    }

    public function replies(){
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }
}