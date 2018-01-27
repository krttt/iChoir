<?php

namespace App\Http\Controllers;
use App\PrivateMessage;
use App\User;
use Auth;
use Illuminate\Http\Request;

class PrivateMessageController extends Controller
{

	    public function __construct()
    {
        $this->middleware('auth');
    }

public function GetNotifications(Request $request)
{
	$notification = PrivateMessage::where('read', 0)->where('receiver_id', $request->user()->id)->orderBy('created_at','desc')->get();
	return response(['data'=> $notifications], 200);
}



public function inbox(Request $request)
{
	$pms = PrivateMessage::where('receiver_id', $request->user()->id)->orderBy('created_at','desc')->get();
$title = 'Inbox';

$pms_sent = PrivateMessage::where('sender_id', $request->user()->id)->orderBy('created_at','desc')->get();


	return view('inbox', array('messages' => $pms, 'sent' => $pms_sent, 'title' => $title ));
}

public function show(Request $request, $id)
{
	$receiver=0;
	$pm = PrivateMessage::where('id', $id)->first();
	if ($pm->read ==0 and $pm->receiver_id==$request->user()->id)
	{
		$pm->read = 1;
		$pm->save();
		$receiver=1;
	}
	if ($pm->read ==1 and $pm->receiver_id==$request->user()->id)
	{
		$receiver=1;
	}
	$title=$pm->subject;
	return view('message_show', array('message' => $pm, 'title' => $title, 'receiver' => $receiver ));
}



public function writeMessage($id)
{
	$write_to = User::find($id);
	$isSender = User::find(auth()->id());
	//dd($write_to);
return view('message_write', array('write_to' => $write_to, 'isSender' => $isSender ));
}


public function store(Request $request)
{

	$data = $request->all();

	$rules = $rules = array(
            'subject' => 'required|min:1',
            'message' => 'required|max:500|min:1',
        );

$this->validate($request, $rules);
        $sender_id = auth()->id();

        $pm = new PrivateMessage();
  		$pm->subject = $data['subject'];
        $pm->message = $data['message'];
        $pm->sender()->associate(User::find($sender_id));
        $pm->receiver()->associate(User::find($data['receiver']));
        $pm->read = 0;
        $pm->save();
        return redirect()->action('PrivateMessageController@inbox')->withMessage('Message sent successfully!');
   


}


}
