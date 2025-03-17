<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $table = 'rentals';
    protected $primaryKey = 'id';
    public $timestamps = false;
    function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
