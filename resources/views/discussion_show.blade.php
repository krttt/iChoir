@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        @if ($discussion->private)
        @include('layouts.left-nav')
        @endif
        <div class="col-md-8 @if($discussion->private==0) col-md-offset-2 @endif">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>{{ $discussion->topic }}</h4>
                </div>

                <div class="panel-body">
                    <h5> {{ $discussion->user->name }}, {{ $discussion->created_at }}  </h5>
                    <p>{{ $discussion->text }}</p>  


@foreach ( $comments as $com )
<hr>

                <div>
                    <h5><strong>{{ $com->user->name }}, {{ $com->created_at->diffForHumans() }} </strong>  </h5>
                    <p>{{ $com->text }}</p>       
                </div>
@endforeach

<hr>
@if (auth()->id())
 <form method="POST" action="{{$discussion->id}}" accept-charset="UTF-8" class="form-horizontal">

 {{ csrf_field() }}




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

            <div class="form-group"> <input class="form-control"  name="discussion" type="hidden" value="{{$discussion->id}}" id="discussion"></div>
            <div class="form-group"> <input class="form-control"  name="event" type="hidden" value="0" id="event"></div>


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

                      