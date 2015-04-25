@extends('website.layouts.master')

@section('master-head')
<style>
    body {
        background: url('/images/VIS-BORA/2.jpg') no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        overflow: hidden;
    }
</style>
<script>
    $(document).ready(function(){
        setInterval(function(){
            var randNum = randomIntFromInterval(1,12);
            console.log('/images/body/'+randNum);
            $('body').css('background-image','url("/images/body/'+randNum+'.jpg")');
        }, 5000);
    });

    function randomIntFromInterval(min,max)
    {
        return Math.floor(Math.random()*(max-min+1)+min);
    }
</script>
@stop

@section('master-body')
<div class="main-tag">
    Welcome to the Philippines
</div>
<div class="sub-tag">
    @foreach($homeslogans as $homeslogan)
        {{ @$homeslogan->content }}
    @endforeach
</div>
<div class="article-div">
    <div class="row">
        @foreach($articles as $article)
            <div class="col-md-3 article-panel">
                <div class="thumbnail">
                    <img src="/images/VIS-BORA/1.jpg" alt="Image" />
                </div>
                <div class="article-headline">
                    {{ $article->title }}
                </div>
                <div class="article-text">
                    @foreach(ArticleContent::where('article_id', $article->id)->orderBy('order', 'ASC')->get() as $x)
                        {{ $x->content }}
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>

@stop