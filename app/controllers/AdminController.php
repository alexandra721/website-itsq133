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
}
