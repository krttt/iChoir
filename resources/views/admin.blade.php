@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Administrator Panel</div>
                <div class="panel-body">
                    @if(session()->has('message'))
                        {{ session()->get('message') }}
                    @endif                    
                    <ul class="list">
                       <li><a href="{{ url('admin', '1') }}">Choir list</a></li>
                       <li><a href="{{ url('admin', '2') }}">User list</a></li>
                       <li><a href="{{ url('admin', '3') }}">Event list</a></li>
                       <li><a href="{{ url('admin', '4') }}">Discussion list</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection