<?php

namespace App\Http\Controllers;
use App\Discussion;
use App\Comment;
use Auth;
use App\Choir;
use Carbon\Carbon;
use App\User;
use Illuminate\Http\Request;

class DiscussionsController extends Controller
{

//         public function __construct()
// {
//     $this->middleware('singer', ['only' => ['choirDiscussions']]);
// }

    public function index()
    {
        return view('discussions_public', array('title' => 'Public discussions', 'discussions' => Discussion::where('private', 0)->orderBy('created_at', 'desc')->get()));
    }

    public function choirDiscussions()
    {
        $choir_id = Auth::user()->hasChoir();
        return view(
            'discussions_private', 
            array('choir'=> Choir::findOrFail($choir_id), 
                'title' => 'Choir discussions', 
        'discussions' => Discussion::where('choir_id', $choir_id)->where('private', 1)->orderBy('created_at')->get()
    )
    ); //tikai Private
    }


    public function show($id)
    {
        $discussion = Discussion::findOrFail($id);
        if(auth()->id()==0 and $discussion->private==1) abort(404);

        if (auth()->id())
        {
            $choir_id = Auth::user()->hasChoir();
            if ($choir_id)
            {
                return view(
                    'discussion_show', 
                    array('choir'=> Choir::findOrFail($choir_id), 
                        'discussion' => Discussion::findOrFail($id),
                        'comments' => Comment::where('discussion_id', $id)->orderBy('created_at')->get()
                )
                );
            }
            else 
                {
                    $discussion = Discussion::findOrFail($id);
                if ($discussion->private==1) abort(404);
                    return view('discussion_show', array('choir'=> 0, 'discussion' => Discussion::findOrFail($id),
'comments' => Comment::where('discussion_id', $id)->orderBy('created_at')->get())
            );}
        }

        else return view('discussion_show', array('choir'=> 0, 'discussion' => Discussion::findOrFail($id),'comments' => Comment::where('discussion_id', $id)->orderBy('created_at')->get()));        
    }



      public function create()
    {

        $choir_id = Auth::user()->hasChoir();
        $choir = Choir::find($choir_id);
        if ($choir_id==0) $choir=0;

        return view('discussion_create')->with(['choir'=>$choir]);  

    }






     public function store(Request $request)
    {
        $data = $request->all();
        
        $rules = $rules = array(
            'topic' => 'required|min:3',
            'text' => 'required|max:500|min:5',
        );
        

        $this->validate($request, $rules);
        $user_id = auth()->id();
        $discussion = new Discussion();

        $discussion->topic = $data['topic'];
        $discussion->text = $data['text'];
        $discussion->private = $data['private'];
        $discussion->user()->associate(User::find($user_id));
        $discussion->choir()->associate(Choir::find(Auth::user()->hasChoir()));
        

        $discussion->save();

if ($discussion->private!=0)
       { return redirect()->action('DiscussionsController@choirDiscussions')->withMessage('Discussion created successfully!');}
   else
{ return redirect()->action('DiscussionsController@index')->withMessage('Discussion created successfully!');}


    }




}



