@extends('website.layouts.master')

@section('master-head')
<style>
    .location-links {
        color : white;
        cursor: pointer;
    }

    body {
        color: white;
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
</style>
<script>
    $(document).ready(function(){

//        $('.div1').click(function(){
//            $(this).slideToggle();
//            $('.div2').fadeIn('slow');
//        });

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
    <div class="col-md-12 ALLIMGDIV" id="image_{{ $location->id }}" style="display: none; text-align: center;">
        <div class="col-md-12"><i class="fa fa-chevron-circle-left backBtn" style="float: left;"></i> <h1>{{ $location->name }}</h1></div>
        <div class="links">
            @foreach(Image::where('location_id', $location->id)->get() as $image)
                <a href="{{ $image->path }}" title="{{ $image->title }}">
                    <img src="{{ $image->path }}" height="100em" width="100em" alt="{{ $image->title }}" style="border-radius: 0.3em; border: 1px solid #95A5A6">
                </a>
            @endforeach
        </div>
    </div>
@endforeach
@stop