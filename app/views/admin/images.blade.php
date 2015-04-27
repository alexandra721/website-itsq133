@extends('admin.layouts.master')

@section('master-head')
<style>
    .btn-file {
        position: relative;
        overflow: hidden;
    }
    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }
</style>

<script>
    $(document).ready(function(){
        $('.uploadBtn').click(function(){
            $('#imgUpload').attr('action', '/admin/upload/'+$(this).attr('data-locid'));
            $('#uploadModal').modal('show');
        });

        $('.upload-modal-btn').click(function(){
            if(document.getElementById('imageUpload').files.length != 0){
                $('#imgUpload').submit()
            }else{
                alert('Please choose files first.');
            }
        });

        $('#imageUpload').change(function(){
            $('.files-names-div').hide();
            var inputFile = document.getElementById('imageUpload');
            for(var i = 0; i < inputFile.files.length; i++){
                $('.file-names').append('<br/>'+inputFile.files[i].name);
            }
            $('.files-names-div').show();
        });

//        document.getElementById('links').onclick = function (event) {
//
//        };

        $('.links').click(function(){
            event = event || window.event;
            var target = event.target || event.srcElement,
                link = target.src ? target.parentNode : target,
                options = {index: link, event: event},
                links = this.getElementsByTagName('a');
            blueimp.Gallery(links, options);
        })

    })
</script>
@stop

@section('master-body')
<h1><i class="fa fa-picture-o"></i> Image Management</h1>
<hr/>

@if(Session::has('error'))
    <div onclick="$(this).fadeToggle()" style="width : 100%; margin-bottom: 0.6em; background-color: #FFA8A8; padding: 0.5em; text-align: center; border: solid 0.1em; border-color: #FFC7C7; border-radius: 0.3em;">
        {{ Session::get('error') }}
    </div>
@endif

@if(Session::has('success'))
<div onclick="$(this).fadeToggle()" style="width : 100%; margin-bottom: 0.6em; background-color: #C7FFE8; padding: 0.5em; text-align: center; border: solid 0.1em; border-color: #A3FFD9; border-radius: 0.3em;">
    {{ Session::get('success') }}
</div>
@endif
<div id="blueimp-gallery" class="blueimp-gallery">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>
@foreach($locations as $location)
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-chevron-up" onclick="$('.body_'+{{$location->id}}).slideToggle();" style="cursor: pointer;"></i> {{ $location->name }}
            <div class="pull-right" style="margin-top: -0.5em; margin-right: -0.8em">
                <a class="btn btn-default uploadBtn" data-locid="{{ $location->id }}"><i class="fa fa-upload"></i> Upload Image</a>
            </div>
        </div>
        <div class="panel-body body_{{ $location->id }}">
            <!--        <div id="links">-->
            <!--            <a href="images/banana.jpg" title="Banana">-->
            <!--                <img src="images/thumbnails/banana.jpg" alt="Banana">-->
            <!--            </a>-->
            <!--            <a href="images/apple.jpg" title="Apple">-->
            <!--                <img src="images/thumbnails/apple.jpg" alt="Apple">-->
            <!--            </a>-->
            <!--            <a href="images/orange.jpg" title="Orange">-->
            <!--                <img src="images/thumbnails/orange.jpg" alt="Orange">-->
            <!--            </a>-->
            <!--        </div>-->
            <div class="links">
                @foreach(Image::where('location_id', $location->id)->get() as $image)
                    <a href="{{ $image->path }}" title="{{ $location->name }}">
                        <img src="{{ $image->path }}" height="100em" width="100em" alt="{{ $location->name }}">
                    </a>
                @endforeach
            </div>
        </div>
        <div class="panel-footer"></div>
    </div>
@endforeach

<!--MODAL CODES-->
{{ Form::open(array('url' => '/admin/upload', 'class' => 'form-horizontal', 'files' => 'true', 'id' => 'imgUpload')) }}
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-upload" style="color: #9B59B6"></i> Upload Image</h4>
                </div>
                <div class="modal-body upload-modal-body">
                    <span class="btn btn-primary btn-file btn-block">
                        Browse image
                        <input type="file" name="imageUpload[]" accept='image/*' multiple id="imageUpload" style="color:transparent;" onchange="this.style.color = 'black';" />
                    </span>

                    <div class="well file-names-div" style="margin-top: 0.6em; overflow-wrap: break-word">
                        Files to be uploaded :
                    <div class="file-names" style="color: #16A085"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="location.href=''">Cancel</button>
                    <button type="button" class="btn btn-success upload-modal-btn">Upload</button>
                </div>
            </div>
        </div>
    </div>
{{ Form::close() }}
@stop