<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Event extends Model
{
    protected $fillable = [
        'name', 'date', 'begin_time', 'end_time', 'price', 'description', 'private'
    ];

    public function city() { 
        return $this->belongsTo('App\City');
    }
    public function choir() { 
        return $this->belongsTo('App\Choir');
    }
        public function comments() {
        return $this->hasMany('App\Comment');
    }
/*
    public function year() {
        return Carbon::createFromFormat('Y-m-d',$this->start_date)->year;        
    }
    
    public function images() {
        return array(
            'server_path' => public_path().'/uploads/',
            'asset_path' => 'uploads/',
            'image_small' => $this->id.'_small.png',
            'image_large' => $this->id.'_large.png',
        );
    }
*/

}
