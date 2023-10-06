<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{

    public function actors()
    {
        return $this->belongsToMany('App\Actor');
    }


    public function genres()
    {
        return $this->belongsToMany('App\Genre');
    }



    protected $fillable = [
        'title', 'year', 'released', 'runtime', 'director',  'imdb_votes'
    ];

}
