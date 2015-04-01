@extends('admin.layouts.master')
@stop

@section('master-body')
<h1><i class="fa fa-comments"></i> Comments</h1>
<hr/>
<div class="panel panel-primary">
    <div class="panel-heading">
        Comments : Total of {{ $comments->count() }} comments
    </div>
    <div class="panel-body">
        @if($comments->count() == 0)
            <i><center><b>No data available.</b></center></i>
        @endif
        @foreach($comments as $comment)

        @endforeach
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        Comments by User
    </div>
    <div class="panel-body">
        @foreach($users as $user)

        @endforeach
    </div>
</div>
@stop