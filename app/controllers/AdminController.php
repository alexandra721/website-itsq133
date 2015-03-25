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

        if(Auth::attempt($userData)){
            $userModel = User::where('username', Input::get('username'));
            if(Auth::user()->status != 'ACTIVATED'){
                Auth::logout();
                return array('msg' => ' <i class="fa fa-warning" style="color: #E74C3C"></i> Account has been deactivated.');
            }else if(Auth::user()->role != 'ADMIN'){
                Auth::logout();
                return array('msg' => ' <i class="fa fa-warning" style="color: #E74C3C"></i> Invalid login credentials.');
            }
            return array('bool' => true);
        }else{
            return array('msg' => ' <i class="fa fa-warning" style="color: #E74C3C"></i> Invalid login credentials.');
        }
    }

    public function home(){
        return View::make('admin.home');
    }

    public function logout(){
        Auth::logout();
        return Redirect::to('/admin/login');
    }

    public function users(){
        return View::make('admin.users')->with('users', User::all())->with('user_count', User::whereNotIn('id', [Auth::user()->id])->count());
    }

    public function deactivate($id){
        User::where('id', $id)->update(array('status' => 'DEACTIVATED'));
        return Redirect::to('/admin/users');
    }
    public function activate($id){
        User::where('id', $id)->update(array('status' => 'ACTIVATED'));
        return Redirect::to('/admin/users');
    }

    public function profile($id){
        return View::make('admin.profile')->with('user', User::where('id', $id)->first())->with('posts', Post::where('user_id', $id))->with('comments', Comment::where('user_id', $id));
    }
}
