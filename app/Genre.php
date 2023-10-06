<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Genre extends Model
{
    //can have many movies
    public function movies()
    {
        return $this->belongsToMany('App\Movie');
    }



    protected $fillable = [
        'description'
    ];
}
