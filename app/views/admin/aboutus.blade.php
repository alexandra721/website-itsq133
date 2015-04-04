@extends('admin.layouts.master')

@section('master-head')
<style>
    .updatemsgDiv {
        background-color: #CCFFE2;
        border: solid 0.1em #7FFAB5;
        border-radius: 0.3em;
        padding: 0.4em;
        margin-bottom: 0.7em;
        color: #4CB57A;
        padding-left: 2em;
    }
</style>
<script>
    $(document).ready(function () { $("#input").cleditor(); });
</script>
@stop

@section('master-body')
<h1><i class="glyphicon glyphicon-heart"></i> About Us</h1>
<hr/>
@if(Session::has('msg'))
    <div class="updatemsgDiv">
        <button type="button" class="close" aria-label="Close" onclick="$('.updatemsgDiv').fadeToggle()"><span aria-hidden="true">&times;</span></button>
         <i class="fa fa-check"></i> {{ Session::get('msg') }}
    </div>
@endif
<!--<textarea id="some-textarea" placeholder="Enter text ..."></textarea>-->
<!--<script type="text/javascript">-->
<!--    $('#some-textarea').wysihtml5();-->
<!--</script>-->

{{ Form::open(array('url' => '/admin/updateAboutus', 'method' => 'POST')) }}
    <textarea id="input" name="aboutus">
        @foreach($aboutus as $about)
            {{ $about->content }}
        @endforeach
    </textarea>
    <hr/>
    <button type="submit" class="btn btn-success pull-right">Save</button>
    <button type="button" class="btn btn-danger pull-right" style="margin-right: 0.4em" data-toggle="modal" data-target="#confirmDelete">Delete All</button>
{{ Form::close() }}

<div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-warning" style="color: red"></i> Confirm content deletion</h4>
            </div>
            <div class="modal-body modal-body-acti">
                Are you sure you want to delete the content of the About Us section of the website?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a class="btn btn-danger" href="/admin/deleteAboutus">Delete</a>
            </div>
        </div>
    </div>
</div>
@stop