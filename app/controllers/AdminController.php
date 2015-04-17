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
            if(Auth::user()->role != 'ADMIN'){
                Auth::logout();
                return array('msg' => ' <i class="fa fa-warning" style="color: #E74C3C"></i> Invalid login credentials.');
            }else if(Auth::user()->status != 'ACTIVATED'){
                Auth::logout();
                return array('msg' => ' <i class="fa fa-warning" style="color: #E74C3C"></i> Account has been deactivated.');
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
        return View::make('admin.users')->with('users', User::paginate(10))->with('user_count', User::whereNotIn('id', [Auth::user()->id])->count());
    }

    public function deactivate($id){
        User::where('id', $id)->update(array('status' => 'DEACTIVATED'));
        return Redirect::back();
//        return Redirect::to('/admin/users');
    }
    public function activate($id){
        User::where('id', $id)->update(array('status' => 'ACTIVATED'));
        return Redirect::back();
//        return Redirect::to('/admin/users');
    }

    public function profile($id){
        return View::make('admin.profile')->with('user', User::where('id', $id)->first())->with('comments', Comment::where('user_id', $id));
    }

    public function changepass($id){
        User::where('id', $id)->update(array('password' => Hash::make(Input::get('changepass-1'))));
        return array('bool' => true);
    }

    public function comments(){
        return View::make('admin.comments')->with('comments', Comment::orderBy('created_at')->paginate(10))->with('users', User::orderBy('id')->paginate(10));
    }

    public function images(){
        return View::make('admin.images')->with('images', Image::all());
    }

    public function videos(){
        return View::make('admin.videos')->with('videos', Image::all());
    }

    public function upload(){
        $files = Input::file('imageUpload');
        if(isset($files)){
            foreach($files as $file) {
                // validating each file.
                $rules = array('file' => 'required|mimes:png,jpeg,jpg'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
                $validator = Validator::make(array('file'=> $file), $rules);
                if($validator->passes()){
                    // path is root/uploads
                    $destinationPath = 'public/upload';
                    $filename = $file->getClientOriginalName();
                    $upload_success = $file->move($destinationPath, $filename);
                    // insert table the details
                    Image::insert(array(
                        'user_id'   =>  Auth::user()->id,
                        'path'      =>  '/upload/'.$filename,
                        'title'     =>  $filename,
                        'description'   =>  'Enter new description',
                    ));
                }
                else {
                    // redirect back with errors.
                    Session::flash('error', $validator);
                    return Redirect::to('/admin/images');
                }
            }
        }else{
            Session::flash('error', 'Please choose an image to upload before submitting');
            return Redirect::to('/admin/images');
        }
        // flash message to show success.
        Session::flash('success', 'Upload success');
        return Redirect::to('/admin/images');
    }

    public function aboutus(){
        return View::make('admin.aboutus')->with('aboutus', Content::where('type', 'aboutus')->get());
    }

    public function homeManage(){
        return View::make('admin.homeManage');
    }

    public function contactus(){
        return View::make('admin.contactus');
    }

    public function updateAboutus(){
        Content::where('type', 'aboutus')->delete();
        if(strlen(Input::get('aboutus')) > 254){
            $string = str_split(Input::get('aboutus'), 254);
            for($i = 0; $i < count($string); $i++){
                Content::insert(array(
                    'type'      =>  'aboutus',
                    'content'   =>  $string[$i],
                    'order'     =>  $i
                ));
            }
        }else{
            Content::insert(array(
                'type'      =>  'aboutus',
                'content'   =>  Input::get('aboutus'),
            ));
        }

        return Redirect::back()->with('aboutus', Content::where('type', 'aboutus')->orderBy('order','ASC')->get())->with('msg', 'About Us : Update successful');
    }

    public function deleteAboutus(){
        Content::where('type', 'aboutus')->delete();
        return Redirect::back()->with('msg', 'About Us : Content has been deleted.');
    }

    public function general(){
        return View::make('admin.general')->with('aboutus', Content::where('type', 'aboutus')->get())->with('slogans', Content::where('type', 'slogan')->get())->with('homeslogans', Content::where('type', 'homeslogan')->get());
    }

    public function updateSlogan(){
        Content::where('type', 'slogan')->delete();
        if(strlen(Input::get('slogan')) > 254){
            $string = str_split(Input::get('slogan'), 254);
            for($i = 0; $i < count($string); $i++){
                Content::insert(array(
                    'type'      =>  'slogan',
                    'content'   =>  $string[$i],
                    'order'     =>  $i
                ));
            }
        }else{
            Content::insert(array(
                'type'      =>  'slogan',
                'content'   =>  Input::get('slogan'),
            ));
        }

        return Redirect::back()->with('aboutus', Content::where('type', 'aboutus')->orderBy('order','ASC')->get())
                                ->with('slogans', Content::where('type', 'slogan')->orderBy('order', 'ASC')->get())
                                ->with('homeslogans', Content::where('type', 'homeslogan')->orderBy('order', 'ASC')->get())
                                ->with('msg', 'Slogan : Update successful');
    }

    public function updateHomeslogan(){
        Content::where('type', 'homeslogan')->delete();
        if(strlen(Input::get('homeslogan')) > 254){
            $string = str_split(Input::get('homeslogan'), 254);
            for($i = 0; $i < count($string); $i++){
                Content::insert(array(
                    'type'      =>  'homeslogan',
                    'content'   =>  $string[$i],
                    'order'     =>  $i
                ));
            }
        }else{
            Content::insert(array(
                'type'      =>  'homeslogan',
                'content'   =>  Input::get('homeslogan'),
            ));
        }

        return Redirect::back()->with('aboutus', Content::where('type', 'aboutus')->orderBy('order','ASC')->get())
            ->with('slogans', Content::where('type', 'slogan')->orderBy('order', 'ASC')->get())
            ->with('homeslogans', Content::where('type', 'homeslogan')->orderBy('order', 'ASC')->get())
            ->with('msg', 'Home Slogan : Update successful');
    }

    public function deleteSlogan(){
        Content::where('type', 'slogan')->delete();
        return Redirect::back()->with('msg', 'Slogan : Content has been deleted.');
    }

    public function deleteHomeslogan(){
        Content::where('type', 'homeslogan')->delete();
        return Redirect::back()->with('msg', 'Home Slogan : Content has been deleted.');
    }

    public function previewAboutus(){
        return View::make('website.about')->with('aboutus', Content::where('type', 'aboutus')->orderBy('order', 'ASC')->get());
    }
}
