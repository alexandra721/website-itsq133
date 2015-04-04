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
{{ Form::open(array('url' => '/admin/updateAboutus', 'method' => 'POST')) }}
    <textarea id="input" name="aboutus">
        @foreach($aboutus as $about)
            {{ $about->content }}
        @endforeach
    </textarea>
    <hr/>
    <button class="btn btn-success pull-right">Save</button>
{{ Form::close() }}


@stop