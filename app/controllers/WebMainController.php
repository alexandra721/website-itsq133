<?php

class WebMainController extends \BaseController {
    public function index(){
        return View::make('website.index')->with('homeslogans', Content::where('type', 'homeslogan')->get());
    }

    public function gallery(){
        return View::make('website.gallery')->with('images', Image::all());
    }

    public function about(){
        return View::make('website.about')->with('aboutus', Content::where('type', 'aboutus')->orderBy('order', 'ASC')->get());
    }

    public function contactus(){
        return View::make('website.contactus');
    }

    public function register(){
        return View::make('website.register')->with('slogans', Content::where('type', 'slogan')->get());
    }

    public function login(){
        return View::make('website.login')->with('slogans', Content::where('type', 'slogan')->get());
    }

    public function doRegister(){
        $msg = 'TRUE';
        // CHECK USERNAME -- START
        if(User::where('username', Input::get('username'))->count() != 0){
            $msg = '<i class="fa fa-warning"></i> Username already exists';
        }else if(!ctype_alnum(Input::get('username'))){
            $msg = '<i class="fa fa-warning"></i> Username is alphanumeric only';
        }else if(strlen(trim(Input::get('username'))) < 5){
            $msg = '<i class="fa fa-warning"></i> Username must be more than 5 characters';
        }
        // CHECK USERNAME -- END

        // CHECK PASSWORD -- START
        if(!ctype_alnum(Input::get('password')) || !ctype_alnum(Input::get('confirm-password'))){
            $msg = '<i class="fa fa-warning"></i> Password is alphanumeric only';
        }else if(strlen(Input::get('password')) < 5 || strlen(Input::get('confirm-password')) < 5){
            $msg = '<i class="fa fa-warning"></i> Password must be more than 5 characters';
        }else if(Input::get('password') != Input::get('confirm-password')){
            $msg = '<i class="fa fa-warning"></i> Password does not match';
        }
        // CHECK PASSWORD -- END

        if($msg == 'TRUE'){
            User::insert(array(
                'username'  =>  Input::get('username'),
                'password'  =>  Hash::make('password'),
                'email'     =>  Input::get('email'),
                'firstname' =>  Input::get('firstname'),
                'lastname'  =>  Input::get('lastname'),
                'role'      =>  'USER',
                'status'    =>  'ACTIVATED',
                'profile_photo' =>  'NONE',
            ));
        }
        return array(
                'msg' => $msg
            );
    }

    public function doLogout(){
        Auth::logout();
        return Redirect::to('/');
    }

    public function doLogin(){
        if(Auth::attempt(array( 'username' => Input::get('username'), 'password' => Input::get('password') ))){
            if(Auth::user()->role == 'ADMIN'){
                Auth::logout();
                return Redirect::back()->with('msg', '<i class="fa fa-warning"></i> Invalid login credentials');
            }else{
                if(Auth::user()->status == 'DEACTIVATED'){
                    Auth::logout();
                    return Redirect::back()->with('msg', '<i class="fa fa-warning"></i> Account has been deactivated. Please contact admin for inquiries');
                }else{
                    return Redirect::to('/home');
                }
            }
        }else{
            return Redirect::back()->with('msg', '<i class="fa fa-warning"></i> Invalid login credentials');
        }
    }
}
