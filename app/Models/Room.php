<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model {

    protected $fillable = [
         'name', 'title', 'price', 'image'
    ];
    
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

}
