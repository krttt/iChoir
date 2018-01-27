@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>All {{$title}}s</h4></div>

                <div class="panel-body">
                    @foreach ( $items as $it )
                    <div class="list-item-with-icon row">
                        <div class="col-md-4">

                        </div>                       
                        <div class="col-md-8">
                        <h4><a href="{{ url('admin/'.$title, $it['id']) }}">{{ $it->name }} @if ($it->name==NULL) {{ $it->topic }} @endif </a></h4>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
