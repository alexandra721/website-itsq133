@extends('admin.layouts.master')

@section('master-head')
    <style>
        body {
            background-color: #34495E;
        }
    </style>
    <script>
        $(document).ready(function(){ ajaxLogin($('#login_form'), $('#login_submitBtn'), $('.div-msg'), $('.login-form')); });
    </script>
@stop

@section('master-body')
    <div class="row" style="margin: 5em;">
        <div class="col-md-offset-4 col-md-4 panel-body" style="background-color: white; border-top-left-radius: 0.4em; border-top-right-radius: 0.4em; margin-top: 6em;">
            <h3><i class="fa fa-gears" style="color: #F39C12"></i> Administrator :: <font color="#3498DB">Login</font></h3>
            {{ Form::open(array('url' => '/admin/doLogin', 'id' => 'login_form', 'name' => 'login_form')) }}
            {{ Form::text('username', Input::old('login-user'), array('class' => 'form-control margin-bottom-10 login-form', 'placeholder' => 'Enter username')) }}
            {{ Form::password('password', array('class' => 'form-control margin-bottom-10 login-form', 'placeholder' => 'Enter password.')) }}
            {{ Form::button('Login', array('class' => 'pull-right-button btn btn-primary center-me login-btn', 'id' => 'login_submitBtn')) }}
            {{ Form::close() }}
            <div class="div-msg">
            </div>
        </div>
        <div class="col-md-offset-4 col-md-4 panel-footer custom-footer">
            Dynamic Promotional Website - Project in ITSQ133<br/>
            Powered by Laravel 4.2
        </div>
    </div>
@stop