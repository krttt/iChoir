@extends('layouts.app')
@section('content')


<div id="app">
   <div class="container">
      <div class="row">
        @if (is_object($choir))
          @include('layouts.left-nav')
          @endif
        
          <div class="col-md-8 @if(!is_object($choir)) col-md-offset-2 @endif">

            <div class="panel panel-default">
               <div class="panel-heading"><h4>Create discussion</h4></div>
               <div class="panel-body">
            <div class="list-item-with-icon row">
               <div class="col-md-8">
                 
                 {!! Form::open(['action' => 'DiscussionsController@store', 'class' => 'form-horizontal']) !!}

 {{ csrf_field() }}

            
                    <div class="form-group{{ $errors->has('topic') ? ' has-error' : '' }}">
                    {!! Form::label('topic', 'Topic', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::text('topic', '', ['class' => 'form-control']) !!}
                    @if ($errors->has('topic'))
                        <span class="help-block">
                            <strong>{{ $errors->first('topic') }}</strong>
                        </span>
                    @endif                      
                    </div>
                    </div>

                    <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
                    {!! Form::label('text', 'Text', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::textArea('text', '', ['class' => 'form-control']) !!}
                    @if ($errors->has('text'))
                        <span class="help-block">
                            <strong>{{ $errors->first('text') }}</strong>
                        </span>
                    @endif                      
                    </div>
                    </div>

                    <div class="form-group{{ $errors->has('private') ? ' has-error' : '' }}">
                    {!! Form::label('private', 'Privacy', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                      @if (is_object($choir))
                    {!! Form::radio('private', '1', true) !!}Private
                    {!! Form::radio('private', '0') !!}Public
                      @endif
                      @if (!is_object($choir))
                      {!! Form::radio('private', '0', true) !!}Public
                      @endif

                    @if ($errors->has('private'))
                        <span class="help-block">
                            <strong>{{ $errors->first('private') }}</strong>
                        </span>
                    @endif                      
                    </div>
                    </div>


<div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                    {!! Form::submit('Create discussion', ['class' => 'btn btn-primary']) !!}
                    </div>
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
