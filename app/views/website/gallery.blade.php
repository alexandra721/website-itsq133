@extends('website.layouts.master')

@section('master-head')
<style>
    .location-links {
        color : white;
        cursor: pointer;
    }

    img {
        box-shadow: 0 8px 6px -6px black;
        vertical-align: 0; !important;
    }

    .backBtn {
        padding-top: 0.5em;
        cursor: pointer;
        color: #ECF0F1;
        font-size: 3em;
        transition : 0.3s;
        opacity: 0.3;
    }

    .backBtn:hover {
        opacity: 1;
    }

    .comment-panel {

    }

    .deleteCommentButton:hover {
        /*background-color: #3498DB;*/
    }

    .comment-item {
        border-radius: 0.2em;
        /*background-color: #ECF0F1;*/
        background-color: white;
        padding: 0.4em;
        -webkit-box-shadow: -4px 4px 15px 0px rgba(0,0,0,0.75);
        -moz-box-shadow: -4px 4px 15px 0px rgba(0,0,0,0.75);
        box-shadow: -4px 4px 15px 0px rgba(0,0,0,0.75);
        margin-bottom: 0.6em;
        padding-bottom: 0.2em;
        margin-right: 0.5em;
    }

    .comment-header {
        font-weight: bold;
        color: #2980B9;
        font-size: 1.1em;
        /*display: inline;*/
    }

    .comment-content {
        display: inline;
        margin: 0 auto;
        overflow-wrap: break-word;
        color: #333333;
        font-size: 0.9em;
    }

    .comment-content:hover {
        overflow: visible;
    }

    .comment-timestamp {
        padding: 0;
        border-top: 1px solid #BDC3C7;
        color: #7F8C8D;
        font-size: 0.7em;
    }

    .reg-trigger {
        color: #3498DB;
    }

    .comment-prompt {
        font-size: 0.9em;
        text-align: center;
        cursor: pointer;
    }
</style>
<script>
    function deleteThisComment(id){
        if(id != null){
            $.ajax({
                type    :   'GET',
                url     :   '/deleteComment/'+id,
                success :   function(data){
                    if(data == 'SUCCESS'){
                        $('.comment_'+id).fadeOut().remove();
                    }else{
                        alert('ERROR 500 : Please check network connectivity.');
                    }
                },error :   function(){
                    alert('ERROR 500 : Please check network connectivity.');
                }
            });
        }else{
            alert('ERROR 500 : Please check network connectivity.');
        }
    }

    $(document).ready(function(){
        $('.comment-container').animate({scrollTop: $('.comment-container')[0].scrollHeight});

        $('.postComment-btn').click(function(){
            var txtArea = $($(this).attr('data-content'));
            if(txtArea.val().length == 0){
                alert('Input cannot be empty');
            }else{
                var form = $($(this).attr('data-form'));
//                console.log(form.attr('action'));
                $.ajax({
                    type        :   'POST',
                    url         :   form.attr('action'),
                    data        :   form.serialize(),
                    success     :   function(data){
                        if(data['msg'] != 'FAILED'){
                            var newComment = '' +
                                '<div class="comment-item" style="display: none;" data-locIdTarget="'+data['id']+'">' +
                                '<div class="comment-header">'
                                +data['name']+
                                '</div>' +
                                '<div>'
                                +data['content']+
                                '</div>' +
                                '<div class="comment-timestamp">' +
                                '<i class="fa fa-clock-o" style="color: #2980B9;"></i> '
                                +data['tStamp']+
                                '</div>' +
                                '</div>',
                                container = $('.comment-container');
                            container.append(newComment);
                            $('[data-locidTarget="'+data['id']+'"]').fadeIn();
//                            container.scrollTop(container[0].scrollHeight);
                            container.animate({scrollTop: container[0].scrollHeight});
//                            $('.comment-container').animate({scrollTop: $(".comment-container").css('height')});
                        }
                    },error     :   function(){
                        alert('Please check network connectivity');
                    }
                })
            }
        });

        $('.location-links').click(function(){
            $('#locations').hide();
            $('#image_'+$(this).attr('data-locid')).fadeIn();
        });

        $('.backBtn').click(function(){
            $('#locations').fadeIn();
            $('.ALLIMGDIV').hide()
        });

    })
</script>
@stop

@section('master-body')

<div style="margin-top: 4em; padding: 1em; text-align: center;" id="locations">
    @foreach($locations as $location)
        <h1 class="location-links" data-locid="{{ $location->id }}">{{ $location->name }}</h1>
    @endforeach
</div>

@foreach($locations as $location)
    <div class="col-md-12 ALLIMGDIV" id="image_{{ $location->id }}" style="display: none;">
        <div class="col-md-12" style="margin-bottom: 1em;"><i class="fa fa-chevron-circle-left backBtn" style="float: left;"></i><h1 style="text-align: center; color: white">{{ $location->name }}</h1></div>
        <div class="col-md-8" style="padding-right: 0; align-content: center;">
            <div class="links">
                @foreach(Image::where('location_id', $location->id)->get() as $image)
                <a href="{{ $image->path }}" title="{{ $image->title }}">
                    <img src="{{ $image->path }}" height="100em" width="100em" alt="{{ $image->title }}" style="border-radius: 0.3em; border: 1px solid #95A5A6">
                </a>
                @endforeach
            </div>
            @if(Video::where('location_id', $location->id)->count() != 0)
                <center>
                    <hr/>
                    @foreach(Video::where('location_id', $location->id)->get() as $video)
                        @if($video->title)
                            <video width="400" controls>
                                <source src="{{ $video->path }}" type="video/mp4">
                                <!--                                        <source src="mov_bbb.ogg" type="video/ogg">-->
                                Your browser does not support HTML5 video.
                            </video>
                        @else
                            {{ $video->path }}
                        @endif
                    @endforeach
                </center>
            @endif
        </div>
        <div class="col-md-4 comment-panel">
            <div style="max-height: 30em; overflow-y: auto;" class="comment-container">
                @foreach(Comment::where('location_id', $location->id)->orderBy('id', 'ASC')->get() as $comment)
                    <div class="comment-item comment_{{$comment->id}}">
                        <div class="comment-header">
                            {{ User::where('id', $comment->user_id)->pluck('firstname') }}
                            @if(Auth::check())
                                @if(Auth::user()->id == $comment->user_id)
                                    <i class="fa fa-times pull-right" style="color: #BDC3C7; cursor: pointer;" onclick="deleteThisComment('{{ $comment->id }}')"></i>
                                @endif
                            @endif    
                        </div>
                        <div class="comment-content">
                            {{ $comment->content }}
                        </div>
                        <div class="comment-timestamp"><i class="fa fa-clock-o" style="color: #2980B9;"></i>
                            {{ $comment->created_at }}
<!--                            <i class="fa fa-trash"></i>-->
                        </div>
                    </div>
                @endforeach
            </div>
            @if(Auth::check())
                <div class="comment-controls" style="margin-top: 1em; margin-bottom: 3em; margin-right: 0.5em">
                    <form class="commentForm_{{$location->id}}" method="POST" action="/postComment/{{ $location->id }}/{{ @Auth::user()->id }}">
                        <textarea name="comment" class="form-control commentContent_{{ $location->id }}" rows="2" placeholder="Say something about {{ $location->name }}.." maxlength="255"></textarea>
                    </form>
                    <button class="btn btn-danger pull-right postComment-btn" data-form=".commentForm_{{ $location->id }}" data-content=".commentContent_{{ $location->id }}" style="border-radius: 0; margin-top: 0.4em; padding-top: 0.1em; padding-bottom: 0.1em; width: 30%;">Post</button>
                </div>
            @else
                <div class="comment-prompt" style="color: #ffffff; margin-top: 1em;">
                    You have to register to post a comment.<br/>
                    Click <a href="/register">here</a> to register.
                </div>
            @endif

        </div>
    </div>
@endforeach
@stop