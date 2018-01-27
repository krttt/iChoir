@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
         @include('layouts.left-nav')
        <div class="col-md-8">
            <div class="panel panel-default">
             
                <div class="panel-heading"><h4>{{$title}}</h4>

                               <h5> <a href="{{ url('/choir/discussions/create') }}"> Create discussion </a></h5>
                </div>

               
                <div class="panel-body">
                     @if(session()->has('message'))
                        {{ session()->get('message') }}
                    @endif
                    @foreach ( $discussions as $disc )
                    <div class="list-item-with-icon row">
                        <div class="col-md-4">

                        </div>                       
                        <div class="col-md-8">
                        <h4><a href="{{ url('discussions', $disc['id']) }}">{{ $disc->topic }}
                        </a></h4>
                        <h5> {{ $disc->user->name }}, {{ $disc->created_at }}  </h5>
                        <div>{{ substr($disc->text, 0, 200) }}. . .</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
