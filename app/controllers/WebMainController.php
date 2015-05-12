<?php

class WebMainController extends \BaseController {
    public function index(){
        return View::make('website.index')->with('homeslogans', Content::where('type', 'homeslogan')->get())->with('articles', Article::orderBy(DB::raw('RAND()'))->get());
    }

    public function gallery(){
        return View::make('website.gallery')->with('locations', Location::all());
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
                'password'  =>  Hash::make(Input::get('password')),
                'email'     =>  Input::get('email'),
                'firstname' =>  Input::get('firstname'),
                'lastname'  =>  Input::get('lastname'),
                'role'      =>  'USER',
                'status'    =>  'ACTIVATED',
                'profile_photo' =>  'NONE',
            ));

            Auth::attempt(array(
                'username'  =>  Input::get('username'),
                'password'  =>  Input::get('password')
            ));
        }
        return array(
                'msg' => $msg
            );
    }

    public function doLogout(){

        date_default_timezone_set("Asia/Manila");
        AuditTrail::insert(array(
            'user_id'   => Auth::user()->id,
            'content'   => 'Logged out at '.date('D, M j, Y \a\t g:ia'),
            'created_at'    =>  date('y:m:d h:m:s')
        ));
        Auth::logout();
//        return Redirect::to('/');
        return Redirect::back();
    }

    public function doLogin(){

        date_default_timezone_set("Asia/Manila");
        if(Auth::attempt(array( 'username' => Input::get('username'), 'password' => Input::get('password') ))){
            AuditTrail::insert(array(
                'user_id'   => Auth::user()->id,
                'content'   => 'Logged in at '.date('D, M j, Y \a\t g:ia'),
                'created_at'    =>  date('y:m:d h:m:s')
            ));

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

    public function getArticle($id){
        return Article::where('id', $id)->first();
    }

    public function postComment($locid, $userid){

        date_default_timezone_set("Asia/Manila");
        $msg = '';
        $content = '';
        $name = Auth::user()->firstname.' '.Auth::user()->lastname;
        date_default_timezone_set("Asia/Manila");
        $tStamp = date("Y:m:d H:i:s");
        $comId = '';
        if(strlen(trim(strip_tags(Input::get('comment')))) != 0){
            Comment::insert(array(
                'user_id'   =>  $userid,
                'content'   =>  Input::get('comment'),
                'location_id'   =>  $locid,
                'created_at'            =>  $tStamp,
                'updated_at'            =>  $tStamp,
            ));
            $msg = 'SUCCESS';
            $content = Input::get('comment');
            $comId = Comment::where('created_at', $tStamp)->where('user_id', $userid)->pluck('id');

            AuditTrail::insert(array(
                'user_id'   => Auth::user()->id,
                'content'   => 'Commented at location '.Location::where('id', $locid)->pluck('name').' at '.date('D, M j, Y \a\t g:ia'),
                'created_at'    =>  date('y:m:d h:m:s')
            ));
        }else{
            $msg = 'FAILED';
        }

        return array(
            'id'    =>  $comId,
            'msg'   =>  $msg,
            'name'  =>  $name,
            'tStamp'    =>  $tStamp,
            'content'   =>  $content
        );
    }

    public function deleteComment($id){
        Comment::where('id', $id)->delete();
        return 'SUCCESS';
    }
}
