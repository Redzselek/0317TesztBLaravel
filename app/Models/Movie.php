<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = 'movies';
    protected $primaryKey = 'id';
    public $timestamps = true;
    function rentals(){
        return $this->hasMany(Rental::class);
    }
}
