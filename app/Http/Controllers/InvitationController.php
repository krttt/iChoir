<?php

namespace App\Http\Controllers;
use App\Choir;
use App\User;
use App\Invitation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Auth;
use Session;
use Illuminate\Http\Request;
use App\Mail\InvitationSend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class InvitationController extends Controller
{



	public function send(Request $request)
    {
        
        $data = $request->all();
        
        $rules = $rules = array(
            'email' => 'required|string|email|max:255|',
        );
        
        $this->validate($request, $rules);
        
        $choir_id = Auth::user()->hasChoir();
        $invitation = new Invitation();

        $invitation->email = $data['email'];
        $invitation->choir()->associate(Choir::find($choir_id));
		$invitation->sent_at = NULL;
		$invitation->accepted_at = NULL;
		$invitation->rejected_at = NULL;
        $invitation->save();


		//$id=$invitation->id;
        /*if (! Gate::allows('invitation_view')) {
            return abort(401);
        }*/



        Mail::to($invitation->email)->send(new InvitationSend($invitation));
        $invitation->update(['sent_at' => Carbon::now()->toDateTimeString()]);

   //return redirect()->action('ChoirController@index')->withMessage('Invitation sent!'); 
Session::flash('success', 'Invitation sent!');
        return redirect()->back();

    }




    public function accept($invitation_id, $action)
    {
        $invitation = Invitation::findOrFail($invitation_id);
        if (!in_array($action, ['accept', 'reject'])) {
            abort(404);
        }
        if ($action == 'accept') {

            $invitation->update(['accepted_at' => Carbon::now()->toDateTimeString()]);
            $invited_person=User::where('email', $invitation->email)->get();
            if ($invited_person->isEmpty())
            {
                Session::flash('success', 'You are not registered! Please register and then accept the invitation');
                return redirect()->route('register');
            }  
            $invited_person=User::where('email', $invitation->email);
            $invited_person->update(['choir_id'=> $invitation->choir_id]);
            $invited_person->update(['role'=> '2']);
        }
        if ($action == 'reject') {
            $invitation->update(['rejected_at' => Carbon::now()->toDateTimeString()]);
            $invited_person=User::where('email', $invitation->email)->get();
            if ($invited_person->isEmpty())
            {
                Session::flash('success', 'You are not registered! Please register and then reopen the invitation');
                return redirect()->route('register');
            } 
        }

        $message='Your invitation was successfully ' . $action . 'ed';

        return redirect()->action('EventsController@index')->withMessage($message);
    }






}
