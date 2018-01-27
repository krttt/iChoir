@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>{{$title}}</h4></div>

                <div class="panel-body">
                    <h4><strong>Received messages:</strong></h4>
                    @if ($messages->isEmpty())
                    <h5> No new messages </h5>
                    @endif
                    
                             @if(session()->has('message'))
                        {{ session()->get('message') }}
                    @endif  

                    @foreach ( $messages as $mes )
                    @if ($mes->read==0) <font color="red"> New message </font> @endif
                    <div class="list-item-with-icon row">
                     
                        <div class="col-md-8">
                        <h4><a href="{{ url('inbox/message', $mes['id']) }}">Subject: {{ $mes->subject }}</h4> 
                        </a>

                         <h5>
<a href="{{ url('profile', $mes->sender->id) }}">By: {{$mes->sender->name}}
                        </a></h5>
                         <p>Received at: {{ $mes->created_at }}
                        </p>
                        </div>

                    </div>
                     <hr>
                    @endforeach
 <hr> <hr>
 <h4><strong>Sent messages:</strong></h4>
                    @if ($sent->isEmpty())
                    <h5> No sent messages </h5>
                    @endif

                                        @foreach ( $sent as $se )

                    <div class="list-item-with-icon row">
                     
                        <div class="col-md-8">
                        <h4><a href="{{ url('inbox/message', $se['id']) }}">Subject: {{ $se->subject }}</h4> 
                        </a>

                         <h5>
<a href="{{ url('profile', $se->receiver->id) }}">To: {{$se->receiver->name}}
                        </a></h5>
                         <p>Sent at: {{ $se->created_at }}
                        </p>
                        </div>

                    </div>
                     <hr>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
