@extends('website.layouts.master')

@section('master-head')
<style>
    body {
        background-image: url('/images/home.jpg');
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        overflow: hidden;
    }
</style>
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
@stop