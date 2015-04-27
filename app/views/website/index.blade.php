@extends('website.layouts.master')

@section('master-head')
<style>
    body {
        background: url('/images/body/12.jpg') no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        overflow: hidden;

        /*transition : 1s;*/
        /*-webkit-transition: opacity 3s ease-in-out;*/
        /*-moz-transition: opacity 3s ease-in-out;*/
        /*-ms-transition: opacity 3s ease-in-out;*/
        /*-o-transition: opacity 3s ease-in-out;*/
    }
</style>
<script>
    $(document).ready(function(){
        setInterval(function(){
            var randNum = randomIntFromInterval(1,12);
            console.log('/images/body/'+randNum);
            $('body').css('background-image','url("/images/body/'+randNum+'.jpg")');
        }, 5000);

        $('.article-trigger').click(function(){
            var ArtUrl = '/getArticle/'+$(this).attr('data-artid'),
                artId = $(this).attr('data-artid');
            $.ajax({
                type    :   'GET',
                url     :   ArtUrl,
                success :   function(data){
////                    alert(location.hostname+''+data['image']);
//                    var image = new Image();
//                    image.src = location.hostname+'/'+data['image'];
//                    image.onload = function(){
//                      $('.articleModal-img').empty().append(image);
//                    };

                    $('.articleModal-header').empty().append('<center><font style="font-size : 1.8em">'+ data['title'] +'</font></center>');
                    $('.articleModal-body').empty().append($('.article_'+artId).text());

                    var img = $('.image_'+artId).clone();
                    $('.articleModal-img').empty().append(img);

                },error :   function(){
                    alert('Please check network connectivity');
                }
            });

            $('#articleModal').modal('show');
        })
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
<!--                    <img src="/images/VIS-BORA/1.jpg" alt="Image" class="article-trigger" data-artid="{{ $article->id }}"/>-->
                    <img src="{{ $article->image }}" alt="Image" class="article-trigger image_{{ $article->id }}" data-artid="{{ $article->id }}"/>
                </div>
                <div class="article-headline article-trigger" data-artid="{{ $article->id }}">
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

<div class="modal fade" id="articleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header articleModal-header">

            </div>
            <div class="modal-body">
                <div class="thumbnail2 articleModal-img">

                </div>
                <div class="articleModal-body"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@stop