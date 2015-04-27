@extends('website.layouts.master')

@section('master-head')
<style>
    h1 {
        color : white;
    }

    img {
        box-shadow: 0 8px 6px -6px black;
        vertical-align: 0; !important;
    }
</style>
@stop

@section('master-body')

@foreach($locations as $location)
    <h1 style="text-align: center; margin-top: 2em;">{{ $location->name }}</h1>
    <p style="padding: 1em; padding-top: 0; padding-bottom: 0; color: #BDC3C7;"> {{ $location->description }} </p>
    <div class="col-md-12">
        <div class="links">
            @foreach(Image::where('location_id', $location->id)->get() as $image)
                <a href="{{ $image->path }}" title="{{ $image->title }}">
                    <img src="{{ $image->path }}" height="100em" width="100em" alt="{{ $image->title }}" style="border-radius: 0.3em; border: 1px solid #95A5A6">
                </a>
            @endforeach
        </div>
    </div>
    <div class="col-md-12" style="margin-top: 2em; color: white;">
        <div class=""></div>
        @foreach(Comment::where('location_id', $location->id)->get() as $comment)
            {{}}
        @endforeach
<!--        <div style="color: black; padding: 0.4em; border-radius: 0.3em; margin-bottom: 3em;">-->
<!--            <textarea placeholder="Leave a comment" class="form-control" style="width: 35%; margin-bottom: 0.4em;" rows="3"></textarea>-->
<!--            <button class="btn btn-primary">Post</button>-->
<!--        </div>-->
    </div>
@endforeach
@stop