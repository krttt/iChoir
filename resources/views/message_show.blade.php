@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Message: {{$title}}</h4></div>
                     
                    <div class="panel-body">
                    <div class="list-item-with-icon row">
                     
                    <div class="col-md-8">
                        
                        <h4><a href="{{ url('inbox') }}">Go back</a></h4> 
                        
                        

                         <h5>
<a href="{{ url('profile', $message->sender->id) }}">By: {{$message->sender->name}}
                        </a></h5>
                         <p>Received at: {{ $message->created_at }}</p>

                            <hr>
                        <div><p>{{ $message->message }}</p></div>
                        <hr>
@if ($receiver==1)
<h4><a href="{{ url('inbox/write', $message->sender->id) }}">Write a message to {{$message->sender->name}}</a></h4> 
@endif
@if ($receiver==0)
<h4><a href="{{ url('inbox/write', $message->receiver->id) }}">Write a message to {{$message->receiver->name}}</a></h4> 
@endif
                    </div>

                    </div>
                     
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
