<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Choir;
use App\Country;
use App\User;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;



class ChoirController extends Controller
{
        public function index()
    {

        if(auth()->id()==0) abort(404);
        $choir_id = Auth::user()->hasChoir();
        $isConductor = Auth::user()->isConductor();
        $choir = Choir::findOrFail($choir_id);
        $picture = $choir->image()['image'];
        $url = Storage::url($picture);
        $choir->url = $url;
        return view('choir')->with(['choir'=>$choir, 'isConductor'=>$isConductor, 'members' => User::where('choir_id', $choir_id)->orderBy('name')->get()]);  
    }

    public function create()
    {  
        if(Auth::user()->isSinger()) abort(404);
        $countries = Country::all()->map(function ($country) {
            return ['name'=>$country->name, 'cities' => $country->cities->pluck('name', 'id')];
        })->pluck('cities', 'name')->toArray();
        return view('create_choir', array('countries' => $countries));
    }


     public function store(Request $request)
    {
        if(Auth::user()->isSinger()) abort(404);
        $data = $request->all();
        $rules = $rules = array(
            'name' => 'required|min:3',
            'description' => 'required|max:500|min:5',
            'image' => 'required|image|mimes:jpeg,bmp,png|dimensions:max_width=2000',
        );     
        $this->validate($request, $rules);        
        $choir = new Choir();
        $choir->name = $data['name'];
        $choir->description = $data['description'];
        $choir->save();
        Auth::user()->choir()->associate(Choir::find($choir->id));
        Auth::user()->save();
        $image = $choir->image();
        $file = $request->file('image')->storeAs('public', $image['image']);
        return redirect()->action('ChoirController@index')->withMessage('Choir created successfully!');
    }
    
}

