<?php

namespace App\Http\Controllers;
use Auth;
use App\Choir;
use App\User;
use Illuminate\Http\Request;

class ConductorController extends Controller
{
        public function __construct() {
        // only conductor have access
        $this->middleware('conductor');
    }

        public function newMember()
    {
        $choir_id = Auth::user()->hasChoir();
        $choir = Choir::findOrFail($choir_id);
        return view('add_new_choir_member')->with(['choir'=>$choir, 'members' => User::where('choir_id', $choir_id)->orderBy('name')->get()]);  
    }

}
