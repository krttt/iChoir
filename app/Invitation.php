<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{

    protected $fillable = ['email', 'sent_at', 'accepted_at', 'rejected_at'];


    public function choir() { 
        return $this->belongsTo('App\Choir');
    } 
}
