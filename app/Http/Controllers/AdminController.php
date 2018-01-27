<?php

namespace App\Http\Controllers;
use App\Event;
use App\User;
use App\Discussion;
use App\Choir;
use App\Country;
use App\Comment;
use App\City;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;



class AdminController extends Controller
{
    // Middleware
    public function __construct() {
        // only Admin have access
        $this->middleware('admin');
    }
    
    public function __invoke() {
        return view('admin');
    }    

public function index()
    {
        return view('admin');
    }

    public function show($id)
    {
    	if ($id==1) { $items = Choir::all(); $title = "choir"; }
    	if ($id==2) { $items = User::all(); $title = "profile"; }
    	if ($id==3) { $items = Event::all(); $title = "event"; }
    	if ($id==4) { $items = Discussion::all(); $title = "discussion"; }

    		return view('admin.all_items', array('title' => $title, 'items' => $items));
    }


public function choir($id)
    {
        $choir_id = $id;
        $isConductor = 1;
        Auth::user()->choir_id=$id; Auth::user()->save();
        $choir = Choir::findOrFail($id);

$picture = $choir->image()['image'];
        $url = Storage::url($picture);
        $choir->url = $url;

        //return redirect()->action('EventsController@choirEvents');
        return view('choir')->with(['choir'=>$choir, 'isConductor'=>$isConductor, 'members' => User::where('choir_id', $choir_id)->orderBy('name')->get()]);  
    }

public function event($id)
    {      
        $event = Event::findOrFail($id);
        $choir = Choir::findOrFail($event->choir->id);
        Auth::user()->choir_id=$choir->id; Auth::user()->save();
        $isConductor = 1;
        return view('event_show', array('isConductor'=> $isConductor, 'choir'=> $choir, 'event' => Event::findOrFail($id), 'comments' => Comment::where('event_id', $id)->orderBy('created_at')->get()));
    }
public function discussion($id)
    {      
        $discussion = Discussion::findOrFail($id);
        $choir_id = $discussion->choir_id;
        Auth::user()->choir_id=$choir_id; Auth::user()->save(); 
        
        return view('discussion_show', array(
                        'discussion' => $discussion,
                        'comments' => Comment::where('discussion_id', $id)->orderBy('created_at')->get()
                )  );
}






}
