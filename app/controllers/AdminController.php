<?php

class AdminController extends \BaseController {
    public function index(){
        if(Auth::check()){
            if(Auth::user()->role != 'ADMIN'){
                Auth::logout();
                return View::make('admin.index');
            }else{
                return Redirect::to('/admin/home');
            }
        }else{
            return View::make('admin.index');
        }
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

    public function logout(){
        Auth::logout();
        return Redirect::to('/admin/login');
    }

    public function users(){
        return View::make('admin.users')->with('users', User::all());
    }

    public function deactivate($id){
        User::where('id', $id)->update(array('status' => 'DEACTIVATED'));
        return Redirect::to('/admin/users');
    }
    public function activate($id){
        User::where('id', $id)->update(array('status' => 'ACTIVATED'));
        return Redirect::to('/admin/users');
    }

}
