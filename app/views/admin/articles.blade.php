@extends('admin.layouts.master')

@section('master-head')
<script>
    $(document).ready(function(){
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
                </div>
                <div class="panel-footer" style="border: solid 0.1em #BDC3C7">
                    <div class="btn-group btnSet1_{{ $article->id }}" role="group" aria-label="...">
                        <button type="button" class="btn btn-default"><i class="glyphicon glyphicon-upload"></i> Upload Image</button>
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
@stop