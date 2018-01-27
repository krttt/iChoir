<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function events() {
        return $this->hasMany('App\Event');
    }
    
    public function country() {
        return $this->belongsTo('App\Country');
    }
}
