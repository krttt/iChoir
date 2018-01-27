<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Discussion extends Model
{
    protected $fillable = [
        'topic', 'text', 'private'
    ];

    public function user() { 
        return $this->belongsTo('App\User');
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
