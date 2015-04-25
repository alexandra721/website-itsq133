@extends('website.layouts.master')

@section('master-head')
<style>
    body {
        background-image: url('/images/about.jpg');
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
</style>
@stop

@section('master-body')
<h2 class="col-md-offset-1 about-header"><i class="fa fa-heart" style="color: #E74C3C"></i> About us</h2>
<div class="about-content col-md-offset-1 col-md-10 panel-body" style="text-align: justify;">
    @foreach($aboutus as $about)
        {{ $about->content }}
    @endforeach
</div>
<!--<div class="col-md-offset-1 col-md-10 panel-footer custom-footer" style="margin-bottom: 4em;">-->
<!--    Dynamic Promotional Website - Project in ITSQ133<br/>-->
<!--    Powered by Laravel 4.2-->
<!--</div>-->
@stop