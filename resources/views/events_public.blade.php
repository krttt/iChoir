@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>{{$title}}</h4></div>

                <div class="panel-body">
                    @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
 @if(session()->has('message'))
                <div class="alert alert-success">
        <ul>
            <li>{{ session()->get('message') }}</li>
        </ul>
    </div>
                      
                    @endif  
                    @foreach ( $events as $eve )
                    <div class="list-item-with-icon row">
                        <div class="col-md-4">

                        </div>                       
                        <div class="col-md-8">
                        <h4><a href="{{ url('events', $eve['id']) }}">{{ $eve->name }}
                        </a></h4>

                       <div> Date and place: {{ $eve->date }}, {{$eve->city->name}}, {{$eve->city->country->name}}</div>
                        <div>Event time: {{ $eve->begin_time }} - {{ $eve->end_time }}</div>
                        @if($eve->price==0)<div>Free entry</div> @endif
                       @if($eve->price!=0) <div>Price: {{ $eve->price }} &euro;</div>  @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
