<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fileentry extends Model
{
	public function isImage($id) {
		return (substr($this->mime, 0, 5) == 'image');
    } 
}
