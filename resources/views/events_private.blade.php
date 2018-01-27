@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
         @include('layouts.left-nav')
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>{{$title}}</h4>
                        @if (Auth::user()->role==3 or Auth::user()->role==4)
                               <h5> <a href="{{ url('/choir/events/create') }}"> Create Event </a></h5>
                               @endif
                </div>


               
                <div class="panel-body">
                    @if(session()->has('message'))
                        {{ session()->get('message') }}
                    @endif
                    <h4>Private</h4>
                    @foreach ( $private as $pri )
                    <div class="list-item-with-icon row">
                        <div class="col-md-4">

                        </div>                       
                        <div class="col-md-8">
                        <h4><a href="{{ url('choir/events', $pri['id']) }}">{{ $pri->name }} {{ $pri->date }}, {{$pri->city->name}}, {{$pri->city->country->name}}
                        </a></h4>
                        <div>{{ $pri->begin_time }} - {{ $pri->end_time }}</div>
                        <div>{{ $pri->price }}</div>
                        </div>
                    </div>
                    @endforeach

                    <h4>Public</h4>
                    @foreach ( $public as $pub )
                    <div class="list-item-with-icon row">
                        <div class="col-md-4">

                        </div>                       
                        <div class="col-md-8">
                        <h4><a href="{{ url('events', $pub['id']) }}">{{ $pub->name }} {{ $pub->date }}, {{$pub->city->name}}, {{$pub->city->country->name}}
                        </a></h4>
                        <div>{{ $pub->begin_time }} - {{ $pub->end_time }}</div>
                        <div>{{ $pub->price }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
