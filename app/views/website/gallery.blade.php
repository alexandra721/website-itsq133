@extends('website.layouts.master')

@section('master-head')
<style>
    h2 {
        color : white;
    }
</style>
<script>
    $(document).ready(function(){
        document.getElementById('links').onclick = function (event) {
            event = event || window.event;
            var target = event.target || event.srcElement,
                link = target.src ? target.parentNode : target,
                options = {index: link, event: event},
                links = this.getElementsByTagName('a');
            blueimp.Gallery(links, options);
        };
    })
</script>
@stop

@section('master-body')

@foreach($locations as $location)
    <h2 style="text-align: center; margin-top: 3em;">{{ $location->name }}</h2>
    <div class="col-md-12">
        <div id="links">
            @foreach(Image::where('location_id', $location->id)->get() as $image)
            <a href="{{ $image->path }}" title="{{ $image->title }}">
                <img src="{{ $image->path }}" height="100em" width="100em" alt="{{ $image->title }}">
            </a>
            @endforeach
        </div>
    </div>
    <div class="col-md-12" style="margin-top: 2em; color: white;">
        @foreach(Comment::where('location_id', $location->id)->get() as $comment)

        @endforeach
        <div style="color: black; padding: 0.4em; border-radius: 0.3em; margin-bottom: 3em;">
            <textarea placeholder="Leave a comment" class="form-control" style="width: 35%; margin-bottom: 0.4em;" rows="4"></textarea>
            <button class="btn btn-primary">Post</button>
        </div>
    </div>
@endforeach
<div class="col-md-12">

</div>
@stop