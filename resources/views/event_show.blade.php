@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        @if ($event->private!=0)
        @include('layouts.left-nav')
        @endif
        <div class="col-md-8 @if($event->private==0) col-md-offset-2 @endif">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>{{ $event->name }} {{ $event->date }}, {{$event->city->name}}, {{$event->city->country->name}}</h4>
                </div>

                <div class="panel-body">

@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif

                       @if ($choir->id==$event->choir->id and $isConductor)

                    <div class="row">
                    <div class="col-sm-3">
                             {!! Html::linkRoute('events.edit', 'Update Event', array($event->id), array('class' => 'btn btn-primary')) !!}
                       </div>   
                   <div>
 
                     {!! Form::open(['route'=>['events.destroy', $event->id], 'method'=> 'DELETE']) !!}
 {!! Form::submit('Delete', ['class'=> 'btn btn-danger'])!!}
                     {!! Form::close() !!}
 
                     </div>
                 </div>
                   @endif




                    <p>Time: {{ $event->begin_time }} - {{ $event->end_time }}</p>
                    <p>Hosting choir: {{ $event->choir->name }} </p>
                    <p>Price: {{ $event->price }} &euro;</p>
                    <p>Description: {{ $event->description }}</p>   



@foreach ( $comments as $com )
<hr>

                <div>
                    <h5><strong>{{ $com->user->name }}, {{ $com->created_at->diffForHumans() }} </strong>  </h5>
                    <p>{{ $com->text }}</p>       
                </div>
@endforeach

<hr>


@if (auth()->id())
 <form method="POST" action="{{$event->id}}" accept-charset="UTF-8" class="form-horizontal">

 {{ csrf_field() }}


<div class="form-group"> <input class="form-control"  name="discussion" type="hidden" value="0" id="discussion"></div>
            <div class="form-group"> <input class="form-control"  name="event" type="hidden" value="{{$event->id}}" id="event"></div>

                        <div class="form-group">
                           <label for="text" class="col-md-4 control-label">Comment</label>
                           <div class="col-md-6">
                              <input class="form-control"  name="text" type="textArea"  id="text">
               @if ($errors->has('text'))               <span class="help-block">
                                <strong>The comment should not be empty.</strong>
                            </span>
                            @endif
                           </div>
                        </div>

            
                     <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                           <input class="btn btn-primary" type="submit" value="Comment">
                        </div>
                     </div>         
 </form>
 @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
