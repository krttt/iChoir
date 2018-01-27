@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>{{$title}}</h4></div>

                <div class="panel-body">

                             @if(session()->has('message'))
                        {{ session()->get('message') }}
                    @endif    
                   
                    <div class="list-item-with-icon row">
                

                        <div class="col-md-8">
                            <h4> {{ $User_LookingAt->name }} </h4>
                             @if($User_isLooking->role==4 and !$User_LookingAt->isBlocked and !$User_LookingAt->isAdmin())
               {!! Form::open(['route'=>['profile.destroy', $LookingAt], 'method'=> 'DELETE']) !!}
 {!! Form::submit('Block', ['class'=> 'btn btn-danger'])!!}
                     {!! Form::close() !!}
                @endif

                @if($User_isLooking->role==4 and $User_LookingAt->isBlocked and !$User_LookingAt->isAdmin())
               {!! Form::open(['route'=>['profile.update', $LookingAt], 'method'=> 'PUT']) !!}
 {!! Form::submit('Unblock', ['class'=> 'btn btn-success'])!!}
                     {!! Form::close() !!}
                @endif


                           @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
                            @if ($isLooking==$LookingAt)
                            <li><a href="{{ url('inbox') }}">Inbox</a></li>    
                            @if ($User_isLooking->choir_id and !$User_LookingAt->isAdmin())
                            <li><a href="{{ url('choir') }}">My choir</a></li> 
                            @endif
                            @endif

                             @if ($isLooking!=$LookingAt)
                            <h4><a href="{{ url('inbox/write', $LookingAt) }}">Write a message to {{$User_LookingAt->name}}</a></h4> 
                            @endif

                     
                        <h4>About me:</h4>
                      
                        @if($User_LookingAt->hasChoir()!=0 and !$User_LookingAt->isAdmin())
                         <h5>Sings in: {{ $User_LookingAt->choir->name }} </h5>
                         @endif

                          @if($User_LookingAt->role==1 )
                         <h5>Role: Just lookin' around... <h5>
                            @endif
                        @if($User_LookingAt->role==3 )
                         <h5>Role: Conductor <h5>
                            @endif
                        @if($User_LookingAt->role==2 )
                         <h5>Role: Singer <h5>
                            @endif
                            @if($User_LookingAt->role==4 )
                         <h5>Role: Administrator <h5>
                            @endif


                        
                
                        </div>

                    </div>
                
               
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
