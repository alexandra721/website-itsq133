@extends('admin.layouts.master')
@section('master-head')
<style>
    .thumbnail {
        cursor: pointer;
        position: relative;
        width: 100px;
        height: 100px;
        overflow: hidden;
        float: left;
        margin-right: 1em;
        margin-bottom: 0em;
        /*-moz-box-shadow:    3px 3px 5px 6px #ccc;*/
        /*-webkit-box-shadow: 3px 3px 5px 6px #ccc;*/
        box-shadow: 0 8px 6px -6px black;
    }
    .thumbnail img {
        display: inline;
        position: absolute;
        left: 50%;
        top: 50%;
        height: 100%;
        width: auto;
        /*-webkit-transform: translate(-50%,-50%);*/
        /*-ms-transform: translate(-50%,-50%);*/
        transform: translate(-50%,-50%);
    }
    .thumbnail img.portrait {
        width: 100%;
        height: auto;
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
        @if($images->count() == 0)
            <center><i style="font-weight: bold;">No data available.</i></center>
        @else
            @foreach($images as $img)
                <div class="links">
                    <a href="{{ $img->path }}">
                        <div class="thumbnail">
                            <img src="{{$img->path}}" />
                        </div>
                    </a>
                </div>
            @endforeach
        @endif
    </div>
    <div class="panel-footer">
        <a href="/admin/manageBgImg" class="btn btn-default"><span class="glyphicon glyphicon-edit"></span> Manage BG Images</a>
    </div>
</div>

{{ Form::open(array('url' => '/admin/uploadBgImg', 'class' => 'form-horizontal', 'id' => '', 'files' => 'true')) }}
<div class="modal fade" id="uploadBgImg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-upload" style="color: #9B59B6"></i> Upload Background Image</h4>
            </div>
            <div class="modal-body upload-modal-body">
                <span style="font-size: 0.8em; color: red;"><i>*Background images only accepts .jpg, .png and jpeg</i></span>
                <input type="file" name="bgImg[]" accept="image/*" multiple required="required"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="location.href=''">Cancel</button>
                <button type="submit" class="btn btn-success">Upload</button>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}
@stop