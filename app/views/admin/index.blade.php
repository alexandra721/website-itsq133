@extends('admin.layouts.master')

@section('master-head')
    <style>
        body {
            /*background-color: #7F8C8D;*/
        }
    </style>
@stop

@section('master-body')
    <div class="col-md-offset-4 col-md-4" style="background-color: white; border-radius: 0.3em; margin-top: 6em; box-shadow: 0px 0px 3px #888888;">
        <h3><i class="fa fa-user"></i> Administrator Login</h3>
        {{ Form::open(array('url' => '/doLogin', 'id' => 'login_form', 'name' => 'login_form')) }}
            {{ Form::text('username', Input::old('login-user'), array('class' => 'form-control margin-bottom-10', 'placeholder' => 'Enter username')) }}
            {{ Form::password('password', array('class' => 'form-control margin-bottom-10', 'placeholder' => 'Enter password.')) }}
            {{ Form::button('Login', array('class' => 'pull-right-button btn btn-primary center-me', 'id' => 'login_submitBtn')) }}
        {{ Form::close() }}
    </div>
@stop