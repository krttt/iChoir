<?php

namespace App\Http\Controllers;
use App\Event;
use App\Choir;
use App\Country;
use App\Comment;
use App\City;
use Auth;
use Session;

use Illuminate\Http\Request;


class EventsController extends Controller
{

        public function __construct()
{
    $this->middleware('conductor', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
}


    public function index()
    {
        return view('events_public', array('title' => 'Public events', 'events' => Event::where('private', 0)->orderBy('date')->get()));
    }

    public function choirEvents()
    {
        $choir_id = Auth::user()->hasChoir();
        return view('events_private', array('choir'=> Choir::findOrFail($choir_id), 'title' => 'Choir events', 
        'private' => Event::where('choir_id', $choir_id)->where('private', 1)->orderBy('date')->get(),
        'public' => Event::where('choir_id', $choir_id)->where('private', 0)->orderBy('date')->get()
    )); //Atsevišķi Private un Public!!!
    }

        
    public function show($id)
    {
        $event = Event::findOrFail($id);
        if(auth()->id()==0 and $event->private==1) abort(404);
       if (auth()->id()>1)
        {
            $choir_id = Auth::user()->hasChoir();
            $isConductor = Auth::user()->isConductor();
            if ($choir_id)
            {
                return view('event_show', array('isConductor'=>$isConductor, 'choir'=> Choir::findOrFail($choir_id), 'event' => Event::findOrFail($id), 'comments' => Comment::where('event_id', $id)->orderBy('created_at')->get()));
            }
            else 
             {
                $event = Event::findOrFail($id);
                if ($event->private==1) abort(404);
                $choir = (object)[];
            $choir->id=0;
                return view('event_show', array('isConductor'=>$isConductor, 'choir'=> $choir, 'event' => Event::findOrFail($id), 'comments' => Comment::where('event_id', $id)->orderBy('created_at')->get())); 
             }   
        }
       else 
        {
          if (auth()->id()==0)
          {
            $choir = (object)[];
            $choir->id=0;
            return view('event_show', array('isConductor'=> 0, 'choir'=> $choir, 'event' => Event::findOrFail($id), 'comments' => Comment::where('event_id', $id)->orderBy('created_at')->get())); 
          }
          else
            {
                if(Auth::user()->isAdmin())
                {
                $event = Event::findOrFail($id);
                $choir = Choir::findOrFail($event->choir->id);
                Auth::user()->choir_id=$choir->id; Auth::user()->save();
                $isConductor = 1;
                 return view('event_show', array('isConductor'=> $isConductor, 'choir'=> $choir, 'event' => Event::findOrFail($id), 'comments' => Comment::where('event_id', $id)->orderBy('created_at')->get()));
                }
                else abort(404);
           }
        }       
    }


        public function create()
    {
$countries = Country::all()->map(function ($country) {
            return ['name'=>$country->name, 'cities' => $country->cities->pluck('name', 'id')];
        })->pluck('cities', 'name')->toArray();

        $choir_id = Auth::user()->hasChoir();
        $choir = Choir::findOrFail($choir_id);
        return view('event_create')->with(['choir'=>$choir, 'countries' => $countries]);  


    }







     public function store(Request $request)
    {
        $data = $request->all();
        
        $rules = $rules = array(
            'name' => 'required|min:3',
            'description' => 'required|max:500|min:5',
            'city' => 'required|exists:cities,id',
            'date' => 'required|date|before:"12-12-2100"|after_or_equal:"today"',
            'begin_time' => 'required|',
            'end_time' => 'required|after_or_equal:begin_time',
            'price' => 'required|numeric|min:0',
        );
        

        $this->validate($request, $rules);
        
        $event = new Event();

        $event->name = $data['name'];
        $event->description = $data['description'];
        $event->city()->associate(City::find($data['city']));
        $event->date = $data['date'];
        $event->begin_time = $data['begin_time'];
        $event->end_time = $data['end_time'];
        $event->price = $data['price'];
        $event->private = $data['private'];

        $event->choir()->associate(Choir::find(Auth::user()->hasChoir()));

        $event->save();

        return redirect()->action('EventsController@choirEvents')->withMessage('Event created successfully!');



    }






        public function edit($id)
    {
$countries = Country::all()->map(function ($country) {
            return ['name'=>$country->name, 'cities' => $country->cities->pluck('name', 'id')];
        })->pluck('cities', 'name')->toArray();
    $event = Event::findOrFail($id);
    $choir_id = Auth::user()->hasChoir();//šeit it laža -> ļauj labor nepareizos
    $isConductor = Auth::user()->isConductor();
        if ($event->choir_id!=$choir_id and $isConductor!=1)
        {
            abort(404);
        }
        $choir = Choir::findOrFail($choir_id);
        return view('event_edit')->with(['choir'=>$choir, 'countries' => $countries, 'event' => $event]);  


    }
    
    
    
    public function update(Request $request, $id)
    {

        $data = $request->all();
        
        $rules = $rules = array(
            'name' => 'required|min:3',
            'description' => 'required|max:500|min:5',
            'city' => 'required|exists:cities,id',
            'date' => 'required|date',
            'begin_time' => 'required|',
            'end_time' => 'required|after_or_equal:begin_time',
            'price' => 'required|numeric|min:0',
        );


        $this->validate($request, $rules);
        
        $event = Event::find($id);

        $event->name = $data['name'];
        $event->description = $data['description'];
        $event->city()->associate(City::find($data['city']));
        $event->date = $data['date'];
        $event->begin_time = $data['begin_time'];
        $event->end_time = $data['end_time'];
        $event->price = $data['price'];
        $event->private = $data['private'];

        $event->choir()->associate(Choir::find(Auth::user()->hasChoir()));

        $event->save();

        Session::flash('success', 'Event updated successfully!');
        return redirect()->route('events.show', $event->id);
        //->action('EventsController@choirEvent')->withMessage('Event updated successfully!');

    }

     public function destroy($id)
    {
        $event = Event::find($id);
$comment = Comment::where('event_id', $id)->first();
	if ($comment!=NULL)
{

	while ($comment!=NULL)
{	$comment->delete();
	$comment = Comment::where('event_id', $id)->first();
}
}
        $event->delete();
        //return redirect()->back();
        Session::flash('success', 'Event deleted successfully!');
        return redirect()->route('events.index');
        //return redirect()->action('EventsController@choirEvent')->withMessage('Event deleted successfully!');
    }














}
