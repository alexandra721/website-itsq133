@extends('website.layouts.master')

@section('master-head')
<style>
    body {
        background-image: url('/images/login.jpg');
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
</style>
<script>

</script>
@stop

@section('master-body')
<div class="col-md-offset-4 col-md-4 website-login-panel panel-body">
    <div class="login-panel-header">
        <h4>
            @foreach($slogans as $slogan)
                {{ @$slogan->content }}
            @endforeach
        </h4>
    </div>
    <hr/>
    {{ Form::open(array('url' => '/doLogin', 'id' => 'login_form')) }}
        {{ Form::text('username', Input::old('username'), array('class' => 'form-control margin-bottom-10', 'placeholder' => 'Enter your username here')) }}
        {{ Form::password('password' , array('class' => 'form-control margin-bottom-10', 'placeholder' => 'Enter your password here')) }}
        <div class="col-md-8" style="color : #E74C3C; font-size: 0.95em;">
            @if(Session::has('msg'))
                {{ Session::get('msg') }}
            @endif
        </div>
        <div class="col-md-4" style="padding-right: 0em;">
            {{ Form::submit('Login', array('class' => 'btn btn-primary pull-right')) }}
        </div>
    {{ Form::close() }}
</div>
<div class="col-md-offset-4 col-md-4 panel-footer custom-footer">
    Dynamic Promotional Website - Project in ITSQ133<br/>
    Powered by Laravel 4.2
</div>
@stop