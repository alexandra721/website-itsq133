@extends('admin.layouts.master')

@section('master-head')
    <script>
        $(document).ready(function(){
            $('img').click(function(){
                if(confirm('Do you want to delete this image?')){
                    location.href = $(this).attr('data-delete');
                }
            });

            $('.deleteVidBtn').click(function(){
                if(confirm('Do you want to delete this video?')){
                    location.href = $(this).attr('data-delete');
                }
            });
        });
    </script>
@stop

@section('master-body')
<h1><i class="glyphicon glyphicon-flag"></i> Manage Media for {{ $location->name }}</h1>
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

<h3><span class="glyphicon glyphicon-picture"></span> Images</h3>
<div class="well" style="text-align: center;">
    @foreach($images as $image)
<!--    <a href="{{ $image->path }}" title="{{ $location->name }}">-->
        <img src="{{ $image->path }}" height="100em" width="100em" alt="{{ $location->name }}" data-delete="/admin/deleteImage/{{$image->id}}" style="border-radius: 0.3em; border: solid 0.1em #BDC3C7; cursor: pointer;">
<!--    </a>-->
    @endforeach
</div>
<h3><span class="glyphicon glyphicon-film"></span> Videos</h3>

@foreach($videos as $video)
    <div class="well" style="text-align: center;">
        {{ $video->path }}
        <br/>
        <button class="btn btn-danger deleteVidBtn" style="width: 30%" data-delete="/admin/deleteVid/{{$video->id}}">Delete this video</button>
    </div>
@endforeach
@stop