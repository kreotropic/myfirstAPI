<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    //one actor can have many movies
    public function movies()
    {
        return $this->belongsToMany('App\Movie');
    }

    protected $fillable = [
        'name'
    ];
}
