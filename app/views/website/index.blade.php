@extends('website.layouts.master')

@section('master-head')
<style>
    body {
        background: url('/images/body/11.jpg') no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        overflow: hidden;
    }
</style>
<script>
    $(document).ready(function(){
        scripts_HomePage();
    });
</script>
@stop

@section('master-body')
<div class="main-tag" style="display: none;">
    Welcome to the Philippines
</div>
<div class="sub-tag" style="display: none;">
    @foreach($homeslogans as $homeslogan)
        {{ @$homeslogan->content }}
    @endforeach
</div>
@if($articles->count() != 0)
    <div class="article-div">
        <div class="row">
            @foreach($articles as $article)
            <div class="col-md-3 article-panel">
                <div class="thumbnail">
                    <!--                    <img src="/images/VIS-BORA/1.jpg" alt="Image" class="article-trigger" data-artid="{{ $article->id }}"/>-->
                    <img src="{{ $article->image }}" alt="Image" class="article-trigger image_{{ $article->id }}" data-artid="{{ $article->id }}"/>
                </div>
                <div class="article-headline article-trigger title_{{ $article->id }}" data-artid="{{ $article->id }}">
                    {{ $article->title }}
                </div>
                <div class="article-text article_{{ $article->id }}">
                    @foreach(ArticleContent::where('article_id', $article->id)->orderBy('order', 'ASC')->get() as $x)
                    {{ $x->content }}
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endif


<div class="modal fade" id="articleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="body1" style="text-align: center; padding: 2em;">
                <i class="fa fa-circle-o-notch fa-spin" style="color: #BDC3C7; font-size: 3em;"></i><br/>
                <div style="padding: 0.9em">
                    Loading article. Please wait.
                </div>
            </div>
            <div class="body2" style="display: none;">
                <div class="modal-header articleModal-header">

                </div>
                <div class="modal-body">


                        <div class="thumbnail2 articleModal-img"></div>
                        <div class="articleModal-body"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
@stop