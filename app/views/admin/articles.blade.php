@extends('admin.layouts.master')

@section('master-head')
<style>
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
        $('.links').click(function(){
            event = event || window.event;
            var target = event.target || event.srcElement,
                link = target.src ? target.parentNode : target,
                options = {index: link, event: event},
                links = this.getElementsByTagName('a');
            blueimp.Gallery(links, options);
        })

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

        $('.uploadBtn').click(function(){
            $('#imgUpload').attr('action', '/admin/uploadArticleImage/'+$(this).attr('data-artid'));
            $('#uploadModal').modal('show');
        });

        $("#textarea-article").cleditor();

        $('.editArticle').click(function(){
            var id = $(this).attr('data-artid');
            $('#origTitle_'+id).hide();
            $('#title_'+id).show();

            $('#origContent_'+id).hide();
            $('#content_'+id).show();

            $('.btnSet1_'+id).hide();
            $('.btnSet2_'+id).show();
        });

        $('.cancelEdit').click(function(){
            var id = $(this).attr('data-artid');
            $('#origTitle_'+id).show();
            $('#title_'+id).hide();

            $('#origContent_'+id).show();
            $('#content_'+id).hide();

            $('.btnSet1_'+id).show();
            $('.btnSet2_'+id).hide();
        });

        $('.saveEdit').click(function(){
            var id = $(this).attr('data-artid'),
                form = $('#form_'+id),
                newTitle = $('#title_'+id).val(),
                newContent = $('#textareaContent_'+id).val();

            $.ajax({
                url     :   form.attr('action'),
                type    :   form.attr('method'),
                data    :   form.serialize(),
                success :   function(data){
                    if(data['bool'] == 'TRUE'){
                        alert(data['msg']);
                        $('#title_'+id).hide();
                        $('#origTitle_'+id).empty().append(newTitle).show();

                        $('#content_'+id).hide();
                        $('#origContent_'+id).empty().append(newContent).show();

                        $('.btnSet2_'+id).hide();
                        $('.btnSet1_'+id).show();
                    }else{
                        alert(data['msg']);
                    }
                },error :   function(){
                    alert('Please check network connectivity');
                }
            })
        })
    })
</script>
@stop

@section('master-body')
<h1><i class="glyphicon glyphicon-paperclip"></i> Articles for {{ @$location->name }}</h1>
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
        Total : {{ $articles->count() }} article(s)
        <div class="pull-right" style="margin-top: -0.5em; marg
        in-right: -0.8em">
            <a class="btn btn-default" data-target="#addArticleModal" data-toggle="modal"><i class="fa fa-plus"></i> Add Article</a>
        </div>
    </div>
    <div class="panel-body">
        @foreach($articles as $article)
            <form action="/admin/editArticle" method="POST" id="form_{{ $article->id }}">
                <input type="hidden" value="{{ $article->id }}" name="articleId">
                <div class="panel-body" style="border: solid 0.08em #BDC3C7; border-bottom: none; margin-top: 1em; overflow: hidden;">
                    <h3 style="margin: 0; margin-bottom: 0.2em; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                        <span id="origTitle_{{ $article->id }}">{{ $article->title }}</span>
                        <input name="articleTitle" class="form-control" type="text" value="{{ $article->title }}" id="title_{{ $article->id }}" style="display: none;"/>
                    </h3>
                    <div style="font-size: 0.8em; color: #95A5A6;">
                        <span id="origContent_{{ $article->id }}">
                            @foreach(ArticleContent::where('article_id', $article->id)->orderBy('order', 'ASC')->get() as $content)
                                {{ $content->content }}
                            @endforeach
                        </span>
                        <div id="content_{{ $article->id }}" style="display: none;">
                            <textarea rows="10" name="articleContent" id="textareaContent_{{ $article->id }}" class="form-control">
                                @foreach(ArticleContent::where('article_id', $article->id)->orderBy('order', 'ASC')->get() as $content)
                                    @if(strlen(trim($content->content)) > 0)
                                        {{ $content->content }}
                                    @endif
                                @endforeach
                            </textarea>
                        </div>
                    </div>
                    <div class="well" style="margin: 0; margin-top: 1em; padding: 0.4em;">
                        <div class="links">
                            @foreach(Image::where('article_id', $article->id)->get() as $image)
                                <a href="{{ $image->path }}" title="{{ $article->title }}">
                                    <img src="{{ $image->path }}" height="100em" width="100em" alt="{{ $article->title }}" style="border-radius: 0.3em; border: solid 0.1em #BDC3C7">
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="panel-footer" style="border: solid 0.1em #BDC3C7">
                    <div class="btn-group btnSet1_{{ $article->id }}" role="group" aria-label="...">
                        <button type="button" class="btn btn-default uploadBtn" data-artid="{{ $article->id }}"><i class="glyphicon glyphicon-upload"></i> Upload Image</button>
                        <button type="button" class="btn btn-default editArticle" data-artid="{{ $article->id }}"><i class="glyphicon glyphicon-edit"></i> Edit Article</button>
                        <button type="button" class="btn btn-danger" data-artid="{{ $article->id }}"><i class="glyphicon glyphicon-remove-circle"></i> Delete</button>
                    </div>
                    <div class="btn-group btnSet2_{{ $article->id }}" role="group" aria-label="..." style="display: none;">
                        <button type="button" class="btn btn-danger cancelEdit" data-artid="{{ $article->id }}"><i class="glyphicon glyphicon-edit"></i> Cancel</button>
                        <button type="button" class="btn btn-success saveEdit" data-artid="{{ $article->id }}"><i class="glyphicon glyphicon-remove-circle"></i> Save</button>
                    </div>
                </div>
            </form>
        @endforeach
    </div>
</div>

{{ Form::open(array('url' => '/admin/addArticle')) }}
<input type="hidden" value="{{ $location->id }}" name="locId"/>
<div class="modal fade" id="addArticleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus" style="color: #27AE60"></i> Add article for {{ $location->name }}</h4>
            </div>
            <div class="modal-body">
                <input name="articleTitle" type="text" class="form-control margin-bottom-10" placeholder="Enter article title here"/>
                <textarea name="articleContent" class="form-control" rows="10"></textarea>
            </div>
            <div class="modal-footer">
                <div class="pull-right">
                    <button type="button" data-dismiss="modal" class="btn btn-danger cancel-modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}

{{ Form::open(array('url' => '/admin/uploadArticleImage', 'class' => 'form-horizontal', 'files' => 'true', 'id' => 'imgUpload')) }}
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