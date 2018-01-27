@extends('layouts.app')

@section('content')
<script type="text/javascript">
$(document).ready(function () {
    $("#search").keyup(function () {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.post("/search", { search: $('#search').val(), _token: CSRF_TOKEN }, function(data) {
            $('.user').html('');
            $.each(data, function(i, user) {
                var c = '<div class="list-item-with-icon row">\n\
                             <div class="col-md-8">\n\
                               <h4><a href="/profile/'+user.id+'">'+user.name+'</a></h4>\n\
                           </div>';
                 $('.user').append(c);
            });
        });
    })
});
</script>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>User search</h4><input type="text" id="search"></div>
                <div class="panel-body user">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

