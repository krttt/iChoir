<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//Testing Jira-GitHub integration
class Choir extends Model
{

	    protected $fillable = [
        'name'
    ];

        public function events() {
        return $this->hasMany('App\Event');
    }

        public function discussions() {
        return $this->hasMany('App\Discussion');
    }

        public function users() {
        return $this->hasMany('App\User');
    }

    public function invitations() {
        return $this->hasMany('App\Invitation');
    }


        public function image() {
        return array(
            'image' => $this->id.'_image.png',
        );
    }

}
