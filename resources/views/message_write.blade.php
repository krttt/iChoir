@extends('layouts.app')
@section('content')


<div id="app">
   <div class="container">
      <div class="row">
        
          <div class="col-md-8 col-md-offset-2 ">

            <div class="panel panel-default">
               <div class="panel-heading"><h4>Write a message to {{$write_to->name}}</h4></div>
               <div class="panel-body">
            <div class="list-item-with-icon row">
               <div class="col-md-8">
                 
                 {!! Form::open(['action' => 'PrivateMessageController@store', 'class' => 'form-horizontal']) !!}

 {{ csrf_field() }}

            
                    <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                    {!! Form::label('subject', 'Subject', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::text('subject', '', ['class' => 'form-control']) !!}
                    @if ($errors->has('subject'))
                        <span class="help-block">
                            <strong>{{ $errors->first('subject') }}</strong>
                        </span>
                    @endif                      
                    </div>
                    </div>

                    <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                    {!! Form::label('message', 'Message', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::textArea('message', '', ['class' => 'form-control']) !!}
                    @if ($errors->has('message'))
                        <span class="help-block">
                            <strong>{{ $errors->first('message') }}</strong>
                        </span>
                    @endif                      
                    </div>
                    </div>



<div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                    {!! Form::submit('Send', ['class' => 'btn btn-primary']) !!}
                    </div>
                    </div>

<div class="form-group"> <input class="form-control"  name="receiver" type="hidden" value="{{$write_to->id}}" id="receiver"></div>

                    {!! Form::close() !!}

                
      
               </div>

                     
            </div>

          
               </div>
            </div>

         </div>
      </div>
   </div>
</div>
@endsection
