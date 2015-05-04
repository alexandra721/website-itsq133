@extends('admin.layouts.master')
@section('master-head')
<script>
    $(document).ready(function(){
        $('.deleteComment').click(function(){
            if(confirm("Delete this comment?")){
                location.href = $(this).attr('data-href');
            }
        });
    })
</script>
@stop

@section('master-body')
<h1><i class="fa fa-comments"></i> Comments by {{ $user->firstname }} {{ $user->lastname }}</h1>
<hr/>
@if(Session::has('successMsg'))
<div class="updatemsgDiv">
    <button type="button" class="close" aria-label="Close" onclick="$('.updatemsgDiv').fadeToggle()"><span aria-hidden="true">&times;</span></button>
    <i class="fa fa-check"></i> {{ Session::get('successMsg') }}
</div>
@endif

@if(Session::has('errorMsg'))
<div class="updatemsgDiv" style="background-color: #FFC7BD; color: red; border-color: red;">
    <button type="button" class="close" aria-label="Close" onclick="$('.updatemsgDiv').fadeToggle()"><span aria-hidden="true">&times;</span></button>
    <i class="fa fa-warning"></i> {{ Session::get('errorMsg') }}
</div>
@endif
    @foreach(Location::all() as $loc)
<!--        <div class="well" style="">-->
            <h3 style="margin: 0; margin-bottom: 0.4em;">{{ $loc->name }}</h3>
            @foreach(Comment::where('user_id', $user->id)->get() as $comment)
            <div class="col-md-12" style="padding: 0.4em; background-color: white; margin-bottom: 0.7em; border: 1px solid #ECF0F1;">
                <div class="admin-comment-content" style="font-size: 0.8em">
                    {{ $comment->content }}
                </div>
                <div style="border-top: 1px solid #BDC3C7; font-size: 0.8em; margin-top: 0.3em; color: #7F8C8D; padding-top: 0.4em;">
                    <i class="fa fa-clock-o" style="color: #2980B9;"></i> {{ $comment->created_at }}
                    <a class="deleteComment" data-href="/admin/deleteComment/{{ $comment->id }}" style="cursor: pointer;"><i class="fa fa-trash pull-right"></i></a>
                </div>
            </div>
            @endforeach
        <!--</div>-->
    @endforeach
@stop

