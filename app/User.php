<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'choir_id' 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    // determine if User is admin by checking DB field role (2 is admin)
    public function isAdmin() {
        return ($this->role == 4);
    }  

    public function hasChoir() {
        return ($this->choir_id);
    }  

    public function isConductor() {
        return ($this->role == 3);
    } 
    
    public function isSinger() {
        return ($this->role == 2);
    } 

    public function role() {
        return ($this->role);
    } 

    public function discussions() {
        return $this->hasMany('App\Discussion');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }
        
    public function choir() { 
        return $this->belongsTo('App\Choir');
    }  

        public function SendsMessages() {
        return $this->hasMany('App\PrivateMessage');
    }

    public function ReceivesMessages() {
        return $this->hasMany('App\PrivateMessage');
    }

}
