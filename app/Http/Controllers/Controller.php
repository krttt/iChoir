<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\User;
use Auth;
use Illuminate\Http\Request;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
//"UserController"


// public function __construct()
// {
//     $this->middleware('auth', ['only' => ['profile', 'store', 'edit', 'delete', 'getSearch', 'postsearch']]);
//     // Alternativ
// }

public function __construct()
{
    $this->middleware('auth', ['except' => ['show', 'index', 'switchLang', 'register', 'accept']]);
 	
}
	

    public function profile(Request $request, $id)
{
	
	$isLooking = auth()->id();
	$LookingAt = $id;

	$User_isLooking = User::find($isLooking);
	$User_LookingAt = User::find($LookingAt);

$title = 'Profile';

	return view('profile', array(
		'isLooking' => $isLooking, 
		'LookingAt' => $LookingAt, 
		'User_isLooking' => $User_isLooking, 
		'User_LookingAt' => $User_LookingAt, 
		'title' => $title 

	));
}




    // AJAX view
    public function getSearch() {
        return view('search');
    }
    // AJAX search
    public function postSearch(Request $request) {
        return User::where('name', 'LIKE', '%'.$request->get('search').'%')->get();
    }

}
