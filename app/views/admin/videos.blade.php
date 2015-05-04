@extends('admin.layouts.master')

@section('master-head')
    <script>

    </script>
@stop

@section('master-body')
<h1><i class="glyphicon glyphicon-film"></i> Video Management</h1>
<hr/>
@foreach($locations as $location)
<div class="panel panel-primary">
    <div class="panel-heading">
        <i class="fa fa-chevron-up" onclick="$('.body_'+{{$location->id}}).slideToggle();" style="cursor: pointer;"></i> {{ $location->name }}
        <div class="pull-right" style="margin-top: -0.5em; margin-right: -0.8em">
            <a class="btn btn-default uploadBtn" data-locid="{{ $location->id }}" data-target="#uploadModal" data-toggle="modal"><i class="fa fa-upload"></i> Add Video</a>
        </div>
    </div>
    <div class="panel-body body_{{ $location->id }}">
        @foreach(Video::where('location_id', $location->id)->get() as $video)
            <iframe src="{{ $video->path }}"></iframe>
        @endforeach
    </div>
    <div class="panel-footer"></div>
</div>
@endforeach

{{ Form::open(array('url' => '/admin/addVideo', 'class' => 'form-horizontal', 'files' => 'true', 'id' => 'imgUpload')) }}
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-upload" style="color: #9B59B6"></i> Add Video URL</h4>
            </div>
            <div class="modal-body upload-modal-body">
                <input type="text" placeholder="Enter video URL" class="form-control" name="VIDEOURL"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="location.href=''">Cancel</button>
                <button type="button" class="btn btn-success upload-modal-btn">Add</button>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}
@stop