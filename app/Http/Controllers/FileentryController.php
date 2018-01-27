<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Fileentry;
use App\Choir;
use Auth;
 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

class FileentryController extends Controller
{
	   public function __construct()
    {

        $this->middleware('singer');

    }
    public function index()
    {
    	 $choir_id = Auth::user()->hasChoir();
     $entries = Fileentry::where('choir_id', $choir_id)->get();
     //$url = Storage::url($entry->original_filename);
     foreach ($entries as $entry)
{$url = Storage::url($entry->original_filename);
	$entry->url=$url;}
    	// //$entries = 
    	// //return Storage::files('public');
     //    return view('file_exchange', array('choir'=> Choir::findOrFail($choir_id), 'entries'=>$entries));
    	//$entries = Fileentry::all();

		return view('file_exchange', compact('entries'));
    }


	public function add(request $request) {
         $data = $request->all();
        
        $rules = $rules = array(
            'filefield' => 'required|max:3000',
        );  
        $this->validate($request, $rules);

		if ($request->hasFile('filefield'))
		{
			$request->file('filefield');

				$extension = $request->filefield->getClientOriginalExtension();	
				$original_filename = $request->filefield->getClientOriginalName();
				$mime = $request->filefield->getClientMimeType();
				$filename = $request->filefield->getFilename().'.'.$extension;
			$request->filefield->storeAs('public', $original_filename);
		
		$choir_id = Auth::user()->hasChoir();
		$entry = new Fileentry();
		$entry->mime = $mime;
		$entry->original_filename = $original_filename;
		$entry->filename = $filename;
		$entry->choir_id = $choir_id;
 
		$entry->save();

		return redirect()->action('FileentryController@index');
		}
		else
		{
			return redirect()->action('FileentryController@index');//pielikt ziņu
		}
	}

		public function get($filename){
	//return 'yes';

		$entry = Fileentry::where('filename', '=', $filename)->firstOrFail();
		//$url = Storage::url($entry->original_filename);
		//$url = Storage::url('file1.jpg');
		//if (substr($entry->getMimeType(), 0, 5) == 'image') 

		$file = Storage::disk('public')->get($entry->original_filename);
		//dd($file);
 //return redirect()->action('FileentryController@index');
		return (new Response($file, 200))->header('Content-Type', $entry->mime);
	}



}
