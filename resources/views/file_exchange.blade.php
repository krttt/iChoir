@extends('layouts.app')
@section('content')


<div id="app">
   <div class="container">
      <div class="row">
          @include('layouts.left-nav')
         <div class="col-md-8 ">

            <div class="panel panel-default">
               <div class="panel-heading"><h4>Files exchange</h4></div>
               <div class="panel-body">



   <form action="files/add" method="post" enctype="multipart/form-data">
      <h4> Choose a file to upload (not all formats are supported): </h4> <input type="file" name="filefield">
        <input type="submit" value="Upload">
         {{ csrf_field() }}
    </form>



                    
                    @if ($errors->has('filefield'))
                        <span class="help-block">
                            <strong>{{ $errors->first('filefield') }}</strong>
                        </span>
                    @endif                     
                   




 
 <h1> All files</h1>
 
 <div class="row">
 
    <ol>
 @foreach($entries as $entry)
        <li>File name: "{{$entry->original_filename}}"<br> File type: {{$entry->mime}}</li>
 <hr>
 @endforeach
    </ol>
 </div>


<h1> Documents</h1>
 <div class="row">

 <div>

        <ul class="thumbnails">
 @foreach($entries as $entry)
    @if (!($entry->isImage($entry->id)))
            <div class="col-md-4">
                <div class="thumbnail">
                    <div class="caption">
                        <p><strong>{{$entry->original_filename}}</strong></p>
                             <form action="{{route('getentry', $entry->filename)}}" method="get" enctype="multipart/form-data">
        <input type="submit" value="Download">
          {{ csrf_field() }}
    </form>
                    </div>
                </div>
            </div>
        @endif
 @endforeach

 </ul>
 </div>
</div>
 <h1> Pictures</h1>
 

        <ul class="thumbnails">
 @foreach($entries as $entry)
     @if ($entry->isImage($entry->id))
            <div class="col-md-4">
                <div class="thumbnail">
                    <img src="{{route('getentry', $entry->filename)}}" alt="ALT NAME" class="img-responsive" />
                    <div class="caption">
                        <p>{{$entry->original_filename}}</p>
                             <form action="{{route('getentry', $entry->filename)}}" method="get" enctype="multipart/form-data">
        <input type="submit" value="Download">
          {{ csrf_field() }}
    </form>
                    </div>
                </div>
            </div>
        @endif
 @endforeach

 </ul>





            <div class="list-item-with-icon row">
               <div class="col-md-8">
                        
                  <br>
               </div>
            </div>

          
               </div>
            </div>

         </div>
      </div>
   </div>
</div>
@endsection