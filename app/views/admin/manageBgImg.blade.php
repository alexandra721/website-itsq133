@extends('admin.layouts.master')

@section('master-head')
<script>
    $(document).ready(function(){
        $('.bgImage').click(function(){
            if(confirm('Do you want to delete this background image?')){
                location.href = $(this).attr('data-href');
            }
        });
    });
</script>
@stop

@section('master-body')
<h1><i class="fa fa-picture-o"></i> Background Images</h1>
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

<div class="panel panel-primary">
    <div class="panel-heading">
        Background Images : Total of {{ $images->count() }}
        <div class="pull-right" style="margin-top: -0.5em; margin-right: -0.8em">
            <a class="btn btn-default" data-target="#uploadBgImg" data-toggle="modal"><i class="fa fa-plus"></i> Upload BG Image</a>
        </div>
    </div>
    <div class="panel-body">
        <span style="color: red; font-size: 0.9em;"><i>*Click image to delete</i></span><br/>
        @if($images->count() == 0)
            <center><i style="font-weight: bold;">No data available.</i></center>
        @else
            @foreach($images as $img)
                <img class="bgImage" data-href="/admin/deleteImage/{{ $img->id }}" src="{{$img->path}}" width="100em" height="100em" style="border-radius: 0.3em; border: 1px solid #BDC3C7; cursor: pointer;"/>
            @endforeach
        @endif
    </div>
    <div class="panel-footer">
    </div>
</div>
@stop