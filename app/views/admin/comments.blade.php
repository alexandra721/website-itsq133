@extends('admin.layouts.master')
@section('master-head')
<style>
    .admin-comment-content {
        text-align: justify;
        display: block; /* Fallback for non-webkit */
        display: -webkit-box;
        /*max-width: 400px;*/
        height: $font-size*$line-height*$lines-to-show; /* Fallback for non-webkit */
        max-height: 6em;
        /*margin: 0 auto;*/
        font-size: $font-size;
        line-height: $line-height;
        -webkit-line-clamp: 2;
        /*-webkit-line-clamp: $lines-to-show;*/
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .pagination {
        margin: 0;
    }
</style>
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
<h1><i class="fa fa-comments"></i> Comments</h1>
<hr/>
<div class="col-md-8">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Comments : Total of {{ $comments->count() }} comments
        </div>
        <div class="panel-body" style="background-color: #ECF0F1">
            @if($comments->count() == 0)
            <i><center><b>No data available.</b></center></i>
            @endif
            @foreach($comments as $comment)
                <div class="col-md-12" style="padding: 0.4em; background-color: white; margin-bottom: 0.7em;">
                    <span style="color: #2980B9; font-weight: bold;">
                        {{ User::where('id', $comment->user_id)->pluck('firstname') }} {{ User::where('id', $comment->user_id)->pluck('lastname') }}
                    </span>
                    <div class="admin-comment-content" style="font-size: 0.8em">
                        {{ $comment->content }}
                    </div>
                    <div style="border-top: 1px solid #BDC3C7; font-size: 0.8em; margin-top: 0.3em; color: #7F8C8D; padding-top: 0.4em;">
                        <i class="fa fa-clock-o" style="color: #2980B9;"></i> {{ $comment->created_at }}
                        <a class="deleteComment" data-href="/admin/deleteComment/{{ $comment->id }}" style="cursor: pointer;"><i class="fa fa-trash pull-right"></i></a>
                    </div>
                </div>
            @endforeach
            <center>{{ $comments->links() }}</center>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Comments by users
        </div>
        <div class="panel-body" style="background-color: #ECF0F1">
            @foreach($users as $user)
            <div class="col-md-12" style="padding: 0.4em; background-color: white; margin-bottom: 0.7em;">
                        <span style="color: #2980B9; font-weight: bold; cursor: pointer" onclick="location.href='/viewUserComments/{{ $user->id }}'">
                            {{ $user->firstname }} {{ $user->lastname }}
                        </span>


                <!--                    <div class="admin-comment-content" style="font-size: 0.8em">-->
                <!--                        <div></div>-->
                <!--                    </div>-->
                <div style="border-top: 1px solid #BDC3C7; font-size: 1em; margin-top: 0.3em; color: #7F8C8D; padding-top: 0;">
                    {{ Comment::where('user_id', $user->id)->count() }} comments
                </div>
            </div>
            @endforeach

            <center>{{ $users->links() }}</center>
        </div>
    </div>
</div>

@stop