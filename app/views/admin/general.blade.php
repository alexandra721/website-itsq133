@extends('admin.layouts.master')

@section('master-head')
<style>
</style>
<script>
    $(document).ready(function(){
        $("#txtarea-aboutus").cleditor();
        $("#txtarea-slogan").cleditor();
        $("#txtarea-homeslogan").cleditor();
    });
</script>
@stop

@section('master-body')
<h1><i class="glyphicon glyphicon-cog"></i> General Content Manager</h1>
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
<div class="panel panel-primary">
    <div class="panel-heading aboutus-heading" onclick="$('.aboutus-body').slideToggle();"><i class="fa fa-heart"></i> About Us</div>
    <div class="panel-body aboutus-body">
        {{ Form::open(array('url' => '/admin/updateAboutus', 'method' => 'POST')) }}
        <textarea id="txtarea-aboutus" name="aboutus">
            @foreach($aboutus as $about)
            {{ $about->content }}
            @endforeach
        </textarea>
        <hr/>
        <button type="submit" class="btn btn-success pull-right">Save</button>
        <button type="button" class="btn btn-danger pull-right" style="margin-right: 0.4em" data-toggle="modal" data-target="#confirmDelete">Delete All</button>
<!--        <button type="button" class="btn btn-default pull-right" style="margin-right: 0.4em" onclick="location.href='/admin/preview/aboutus'">Preview</button>-->
        <button type="button" class="btn btn-default pull-right" style="margin-right: 0.4em" onclick="window.open('/admin/preview/aboutus','Preview About Us page', 'scrollbars=yes,width=800px,height=600px');">Preview</button>
        {{ Form::close() }}
    </div>
    <div class="panel-footer"></div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading slogan-heading" onclick="$('.slogan-body').slideToggle();"><i class="fa fa-pencil"></i> Slogan</div>
    <div class="panel-body slogan-body">
        <h3>Slogan</h3>
        {{ Form::open(array('url' => '/admin/updateSlogan', 'method' => 'POST')) }}
            <textarea id="txtarea-slogan" name="slogan">
                @foreach($slogans as $slogan)
                    {{ $slogan->content }}
                @endforeach
            </textarea>
            <hr/>
            <button type="submit" class="btn btn-success pull-right">Save</button>
            <button type="button" class="btn btn-danger pull-right" style="margin-right: 0.4em" data-toggle="modal" data-target="#confirmDelete-slogan">Delete All</button>
        {{ Form::close() }}
        <h3 style="margin-top: 4em;">Slogan (Home)</h3>
        {{ Form::open(array('url' => '/admin/updateHomeslogan', 'method' => 'POST')) }}
            <textarea id="txtarea-homeslogan" name="homeslogan">
                @foreach($homeslogans as $homeslogan)
                {{ $homeslogan->content }}
                @endforeach
            </textarea>
            <hr/>
            <button type="submit" class="btn btn-success pull-right">Save</button>
            <button type="button" class="btn btn-danger pull-right" style="margin-right: 0.4em" data-toggle="modal" data-target="#confirmDelete-homeslogan">Delete All</button>
        {{ Form::close() }}
    </div>
    <div class="panel-footer"></div>
</div>

<!--MODAL FOR ABOUTUS -- START-->
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
<!--MODAL FOR ABOUTUS -- END-->

<!--MODAL FOR SLOGAN -- START-->
<div class="modal fade" id="confirmDelete-slogan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-warning" style="color: red"></i> Confirm content deletion</h4>
            </div>
            <div class="modal-body modal-body-acti">
                Are you sure you want to delete the content of the Slogan section of the website?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a class="btn btn-danger" href="/admin/deleteSlogan">Delete</a>
            </div>
        </div>
    </div>
</div>
<!--MODAL FOR SLOGAN -- END-->

<!--MODAL FOR HOMESLOGAN -- START-->
<div class="modal fade" id="confirmDelete-homeslogan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-warning" style="color: red"></i> Confirm content deletion</h4>
            </div>
            <div class="modal-body modal-body-acti">
                Are you sure you want to delete the content of the Home Slogan section of the website?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a class="btn btn-danger" href="/admin/deleteHomeslogan">Delete</a>
            </div>
        </div>
    </div>
</div>
<!--MODAL FOR HOMESLOGAN -- END-->
@stop