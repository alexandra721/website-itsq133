<?php

class AdminController extends \BaseController {
    public function index(){
        return View::make('admin.index');
    }

    public function doLogin(){
        $userData = array(
            'username'  =>  Input::get('username'),
            'password'  =>  Input::get('password')
        );

        return array(
            'bool' => Auth::attempt($userData)
        );
    }

    public function home(){
        return View::make('admin.home');
    }
}
