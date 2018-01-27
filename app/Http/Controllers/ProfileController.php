<?php

namespace App\Http\Controllers;
use App\User;
use Session;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
       
    public function __construct() {
        // only Admin have access
        $this->middleware('admin');
       
    }
	public function show(Request $request, $id)
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
    public function destroy($id)
    {
        $User = User::find($id);
        $User->isBlocked=1;
        $User->save();
        
        Session::flash('success', 'User blocked successfully!');
        return redirect()->back();
    }

        public function update($id)
    {
        $User = User::find($id);
        $User->isBlocked=0;
        $User->save();
        
        Session::flash('success', 'User unblocked successfully!');
        return redirect()->back();
    }
}
