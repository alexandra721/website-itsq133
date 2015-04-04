@extends('website.layouts.master')

@section('master-head')
<style>
    body {
        background-image: url('/images/registration.jpg');
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
</style>

<script>
    $(document).ready(function(){
        websiteLogin($('#login_form'), $('.register-btn'), $('.error-div'));
    });
</script>
@stop

@section('master-body')
    <div class="col-md-offset-2 col-md-8 website-login-panel panel-body">
        <div class="login-panel-header">
            <h4 style="text-align: center;">
                @foreach($slogans as $slogan)
                    {{ @$slogan->content }}
                @endforeach
            </h4>
        </div>
        <hr style="margin-bottom: 0.8em;"/>
        {{ Form::open(array('url' => '/doRegister', 'id' => 'login_form')) }}
            <div class="row">
                <div class="col-md-6">
                    <h5 style="text-align: center; margin-top: 0em;">Personal Information</h5>
                    {{ Form::text('firstname', Input::old('firstname'), array('class' => 'form-control margin-bottom-10 login-input', 'placeholder' => 'Enter your first name here')) }}
                    {{ Form::text('lastname', Input::old('lastname'), array('class' => 'form-control margin-bottom-10 login-input', 'placeholder' => 'Enter your last name here')) }}
                    {{ Form::email('email', Input::old('email'), array('class' => 'form-control margin-bottom-10 login-input', 'placeholder' => 'Enter your email here')) }}
                </div>
                <div class="col-md-6">
                    <h5 style="text-align: center; margin-top: 0em;">Account Information</h5>
                    {{ Form::text('username', Input::old('username'), array('class' => 'form-control margin-bottom-10 login-input', 'placeholder' => 'Enter your username name here')) }}
                    {{ Form::password('password', array('class' => 'form-control margin-bottom-10  login-input', 'placeholder' => 'Enter your password here')) }}
                    {{ Form::password('confirm-password', array('class' => 'form-control margin-bottom-10 login-input', 'placeholder' => 'Confirm password here')) }}
                    <div class="col-md-8 error-div" style="color : #E74C3C; font-size: 0.95em;">
                    </div>
                    <div class="col-md-4" style="padding-right: 0em;">
                        {{ Form::button('Register', array('class' => 'btn btn-success pull-right register-btn', 'style' => 'margin-top : 1em;')) }}
                    </div>
                </div>
            </div>
        {{ Form::close() }}
    </div>
    <div class="col-md-offset-2 col-md-8 panel-footer custom-footer">
        Dynamic Promotional Website - Project in ITSQ133<br/>
        Powered by Laravel 4.2
    </div>
@stop