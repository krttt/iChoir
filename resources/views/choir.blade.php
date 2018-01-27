@extends('layouts.app') 
@section('content')
<div id="app">
    <div class="container">
        <div class="row">
            @include('layouts.left-nav')
            <div class="col-md-8 ">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>{{$choir->name}}</h4>
                    </div>
                    <div class="panel-body">
                                @if(session()->has('message'))
                                <div class="alert alert-success">
                                    <ul>
                                        <li>{{ session()->get('message') }}</li>
                                    </ul>
                                </div>
                                @endif
                       <img src="{{ asset("$choir->url")}}" alt="ALT NAME" class="img-responsive"></img>

                        <div class="list-item-with-icon row">
                            <div class="col-md-8">
                                <br>
                                @if ($isConductor)
                                <form action="/choir/new_member">
                                    <button type="submit" class="btn btn-primary">
                                    Add a new member
                                </button>
                                </form>
                                @endif
                                <h5> Members: </h5>
                                @foreach ( $members as $mem ) @if($mem->id!=1)
                                <div class="list-item-with-icon row">
                                    <div class="col-md-8">
                                        <p><a href="{{ url('profile', $mem['id']) }}">{{ $mem->name }}, {{ $mem->email }}</a></p>
                                    </div>
                                </div>
                                @endif @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
