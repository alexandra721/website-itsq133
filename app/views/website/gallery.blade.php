@extends('website.layouts.master')

@section('master-head')
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
<h3 style="text-align: center; margin-top: 3em;">INSERT SLOGAN HERE</h3>
<div class="col-md-12">
    <div id="blueimp-gallery" class="blueimp-gallery">
        <div class="slides">
            <div class="col-md-12">lol</div>
        </div>
        <h3 class="title"></h3>
        <a class="prev">‹</a>
        <a class="next">›</a>
        <a class="close">×</a>
        <a class="play-pause"></a>
        <ol class="indicator"></ol>
    </div>
    <div id="links">
        @foreach($images as $image)
        <a href="{{ $image->path }}" title="{{ $image->title }}">
            <img src="{{ $image->path }}" height="100em" width="100em" alt="{{ $image->title }}">
        </a>
        @endforeach
    </div>
</div>
@stop