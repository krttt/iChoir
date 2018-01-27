@extends('layouts.app')
@section('content')


<div id="app">
   <div class="container">
      <div class="row">
          @include('layouts.left-nav')
         <div class="col-md-8 ">

            <div class="panel panel-default">
               <div class="panel-heading"><h4>Add a new member</h4></div>
               <div class="panel-body">


            <div class="list-item-with-icon row">
               <div class="col-md-8">
                        <h4>{{$choir->name}}</h4>
                  
                   @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
                 {!! Form::open(['action' => 'InvitationController@send', 'class' => 'form-horizontal']) !!}

 {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    {!! Form::label('email', 'E-mail address', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::text('email', '', ['class' => 'form-control']) !!}
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif    
                    </div>
                    </div>

<div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                    {!! Form::submit('Send', ['class' => 'btn btn-primary']) !!}
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
