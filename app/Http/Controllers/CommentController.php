<?php

namespace App\Http\Controllers;
use App\Comment;
use App\User;
use Validator, Input, Redirect; 
use Auth;

use Illuminate\Http\Request;

class CommentController extends Controller
{
	


public function __construct()
{
    $this->middleware('singer', ['except' => ['store']]);
}

    public function store(Request $request)
    {
        $data = $request->all();
        //dd($data);
        $rules = $rules = array(
            'text' => 'required|max:500|min:1',
        );

        $this->validate($request, $rules);
        $comment = new Comment();
        $comment->text = $data['text'];
        $comment->user()->associate(User::find(auth()->id()));

        $discussion_id=$data['discussion'];
        if ($discussion_id!=0)
        {
        	 $comment->discussion()->associate($discussion_id);
        }
        else
        {
        	$event_id=$data['event'];
        	$comment->event()->associate($event_id);
        }
        
       

        $comment->save();

		return Redirect::back();
        //return redirect()->action('DiscussionsController@show', ['id' => $comment->discussion_id]);



    }
}
