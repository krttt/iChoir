@extends('layouts.app')
@section('content')


<div id="app">
   <div class="container">
      <div class="row">
          @include('layouts.left-nav')
         <div class="col-md-8 ">

            <div class="panel panel-default">
               <div class="panel-heading"><h4>Update Event</h4></div>
               <div class="panel-body">
            <div class="list-item-with-icon row">
               
                 
                        {!! Form::model($event, ['route' => ['events.update', $event->id], 'method' => 'PUT']) !!}
                        {{ csrf_field() }}
         
           

            
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    {!! Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif                      
                    </div>
                    </div>

            
           


                <div class="form-group">
                    {!! Form::label('city', 'City', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::select('city', $countries, $event->city->id, ['class' => 'form-control']) !!}
                    </div>
                    </div>


                    <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                    {!! Form::label('date', 'Date', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::date('date', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('date') }}</strong>
                        </span>
                    @endif                      
                    </div>
                    </div>

                    <div class="form-group{{ $errors->has('begin_time') ? ' has-error' : '' }}">
                    {!! Form::label('begin_time', 'Starting at', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::time('begin_time', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('begin_time'))
                        <span class="help-block">
                            <strong>{{ $errors->first('begin_time') }}</strong>
                        </span>
                    @endif                     
                    </div>
                    </div>

                    <div class="form-group{{ $errors->has('end_time') ? ' has-error' : '' }}">
                    {!! Form::label('end_time', 'Ends at', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::time('end_time', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('end_time'))
                        <span class="help-block">
                            <strong>{{ $errors->first('end_time') }}</strong>
                        </span>
                    @endif                     
                    </div>
                    </div>


                    <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                    {!! Form::label('price', 'Price', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::text('price', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('price'))
                        <span class="help-block">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                    @endif                     
                    </div>

                    </div>


                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    {!! Form::label('description', "Description", ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::textArea('description', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif                      
                    </div>
                    </div>


                    <div class="form-group{{ $errors->has('private') ? ' has-error' : '' }}">
                    {!! Form::label('private', 'Privacy', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::radio('private', '1', true) !!}Private
                    {!! Form::radio('private', '0') !!}Public
                    @if ($errors->has('private'))
                        <span class="help-block">
                            <strong>{{ $errors->first('private') }}</strong>
                        </span>
                    @endif                      
                    </div>
                    </div>





                   

                
                    <div class="col-sm-4">
                        {!! Html::linkRoute('events.show', 'Cancel', array($event->id), array('class' => 'btn btn-danger btn-block')) !!}
                    </div>
                    <div class="col-sm-4">
                        {{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}
                    </div>
              

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
