<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class PrivateMessage extends Model
{
         protected $fillable = [
        'subject','message', 'sender_id', 'receiver_id', 'read'
    ];

protected $appends = ['sender', 'receiver'];

public function getSenderAttribute() { 
        return User::where('id', $this->sender_id)->first();
    }

public function getReceiverAttribute() { 
        return User::where('id', $this->receiver_id)->first();
    }




    public function sender() { 
        return $this->belongsTo('App\User');
    }

    public function receiver() { 
        return $this->belongsTo('App\User');
    }



}
