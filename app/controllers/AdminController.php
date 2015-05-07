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
//        $userList = User::join('comments', 'comments.user_id', '=', 'users.id')->groupBy('users.id')->orderBy('users.firstname', 'ASC')->paginate(5);

//        return View::make('admin.comments')->with('comments', Comment::orderBy('created_at', 'DESC')->paginate(5))->with('users', $userList);
        return View::make('admin.comments')->with('comments', Comment::orderBy('created_at', 'DESC')->paginate(5))->with('users', User::orderBy('firstname', 'ASC')->paginate(5));
    }

    public function images(){
        return View::make('admin.images')->with('images', Image::all())->with('locations', Location::orderBy('name', 'ASC')->get());
    }

    public function videos(){
        return View::make('admin.videos')->with('locations', Location::orderBy('name', 'ASC')->get());
    }

    public function upload($id){
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
                        'location_id'   =>  $id
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
            return Redirect::back();
        }
        // flash message to show success.
        Session::flash('success', 'Upload success');
        return Redirect::back();
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

    public function promotions(){
//        return View::make('admin.promotions')->with('locations', Location::join('articles', 'locations.id', '=', 'articles.location_id')->get())->with('locationCount', Location::all()->count());
        return View::make('admin.promotions')->with('locations', Location::all())->with('locationCount', Location::all()->count());
    }

    public function addLocation(){
//        dd(strlen(trim(Input::get('locationDescription'))));
        if(strlen(trim(Input::get('locationName'))) == 0){
            return Redirect::back()->with('errorMsg', 'Location name must be filled out');
        }else if(strlen(trim(Input::get('locationDescription'))) == 0){
            return Redirect::back()->with('errorMsg', 'Location description must be filled out');
        }else{
            Location::insert(array(
                'name'  =>  strip_tags(Input::get('locationName')),
                'description'   =>  strip_tags(Input::get('locationDescription'))
            ));
            return Redirect::back()->with('successMsg', 'Location has been saved');
        }
    }

    public function editLocation(){
        $bool = 'FALSE';
        if(Input::get('locationName') == null || Input::get('locationDescription') == null){
            $msg = 'Location name and description cannot be empty';
        }else if(strlen(strip_tags(trim(Input::get('locationName')))) == 0 || strlen(strip_tags(trim(Input::get('locationDescription')))) == 0){
            $msg = 'Location name and description cannot be empty';
        }else{
            Location::where('id', Input::get('locationId'))->update(array(
                'name'  =>  strip_tags(trim(Input::get('locationName'))),
                'description'  =>  strip_tags(trim(Input::get('locationDescription'))),
            ));
            $bool = 'TRUE';
            $msg = 'Location details have been updated';
        }

        return array(
            'msg'   =>  $msg,
            'bool'  =>  $bool
        );
    }

    public function article($id){
        return View::make('admin.articles')->with('articles', Article::where('location_id', $id)->get())->with('location', Location::where('id', $id)->first());
    }

    public function addArticle(){
        $bool = false;
        if(Input::get('articleContent') == null || Input::get('articleTitle') == null){
            $msg = 'Article title and content cannot be empty';
        }else if(strlen(strip_tags(trim(Input::get('articleContent')))) == 0 || strlen(strip_tags(trim(Input::get('articleTitle')))) == 0){
            $msg = 'Article title and content cannot be empty';
        }else{
            Article::insert(array(
                'location_id'   =>  Input::get('locId'),
                'title'         =>  Input::get('articleTitle')
            ));

            $articleId = Article::where('location_id', Input::get('locId'))->where('title', Input::get('articleTitle'))->pluck('id');

            if(strlen(Input::get('articleContent')) > 255){
                $string = str_split(Input::get('articleContent'), 255);
                for($i = 0; $i < count($string); $i++){
                    ArticleContent::insert(array(
                        'article_id'    =>  $articleId,
                        'content'       =>  $string[$i],
                        'order'     =>  $i
                    ));
                }
            }else{
                ArticleContent::insert(array(
                    'article_id'    =>  $articleId,
                    'content'       =>  Input::get('articleContent')
                ));
            }

            $bool = true;
            $msg = 'Article is successfully created';
        }

        if($bool){
            return Redirect::back()->with('successMsg', $msg);
        }else{
            return Redirect::back()->with('errorMsg', $msg);
        }
    }

    public function deleteLocation($id){
        Location::where('id', $id)->delete();
        $articleQuery = Article::where('location_id', $id);
        $articleId = $articleQuery->pluck('id');
        $articleQuery->delete();
        ArticleContent::where('article_id', $articleId)->delete();

        return Redirect::to('/admin/promotions')->with('successMsg', 'Location has been successfully deleted');
    }

    public function editArticle(){
        $bool = 'FALSE';
        if(Input::get('articleTitle') == null || Input::get('articleContent') == null){
            $msg = 'Article title and content cannot be empty';
        }else if(strlen(strip_tags(trim(Input::get('articleTitle')))) == 0 || strlen(strip_tags(trim(Input::get('articleContent')))) == 0){
            $msg = 'Article title and content cannot be empty';
        }else{
            Article::where('id', Input::get('articleId'))->update(array(
                'title'  =>  strip_tags(trim(Input::get('articleTitle'))),
            ));

            $ArtContQuery = ArticleContent::where('article_id', Input::get('articleId'));
            $ArtContQuery->delete();

            if(strlen(Input::get('articleContent')) > 255){
                $string = str_split(Input::get('articleContent'), 255);
                for($i = 0; $i < count($string); $i++){
                    ArticleContent::insert(array(
                        'article_id'    =>  Input::get('articleId'),
                        'content'       =>  $string[$i],
                        'order'     =>  $i
                    ));
                }
            }else{
                ArticleContent::insert(array(
                    'article_id'    =>  Input::get('articleId'),
                    'content'       =>  Input::get('articleContent')
                ));
            }

            $bool = 'TRUE';
            $msg = 'Article details have been updated';
        }

        return array(
            'msg'   =>  $msg,
            'bool'  =>  $bool
        );
    }

    public function uploadArticleImage($id){
        $files = Input::file('imageUpload');
        if(isset($files)){
            foreach($files as $file) {
                // validating each file.
                $rules = array('file' => 'required|mimes:png,jpeg,jpg'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
                $validator = Validator::make(array('file'=> $file), $rules);
                if($validator->passes()){
                    // path is root/uploads
                    $destinationPath = 'public/upload_article';
                    $filename = $file->getClientOriginalName();
                    $upload_success = $file->move($destinationPath, $filename);
                    // insert table the details
                    Image::insert(array(
                        'user_id'   =>  Auth::user()->id,
                        'path'      =>  '/upload_article/'.$filename,
                        'title'     =>  $filename,
                        'description'   =>  'Enter new description',
                        'article_id'   =>  $id
                    ));

                    Article::where('id', $id)->update(array(
                        'image' =>  '/upload_article/'.$filename,
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
        return Redirect::back()->with('successMsg', 'Upload is successful');
    }

    public function addVideo($id){
        Video::insert(array(
            'user_id'           => Auth::user()->id,
            'path'              => Input::get('VIDEOURL'),
            'location_id'       => $id,
        ));

        return Redirect::back()->with('successMsg', 'Video URL saved');
    }

    public function addVideoFile($id){
        $file = Input::file('video');

        if($file->getClientOriginalExtension() != 'mp4'){
            return Redirect::back()->with('errorMsg', 'Only .mp4 video files are allowed');
        }

        $destinationPath = 'public/upload/video';
        $filename = $file->getClientOriginalName();
        $upload_success = $file->move($destinationPath, $filename);

        Video::insert(array(
            'user_id'       =>  Auth::user()->id,
            'path'          =>  '/upload/video/'.$filename,
            'title'         =>  $filename,
            'description'   =>  'Enter new description',
            'location_id'   =>  $id
        ));

        return Redirect::back()->with('successMsg', 'Upload is successful');
    }

    public function manageMedia($id){
        return View::make('admin.manageMedia')
            ->with('images', Image::where('location_id', $id)->get())
            ->with('videos', Video::where('location_id', $id)->get())
            ->with('location', Location::where('id', $id)->first());
    }

    public function deleteImage($id){
        Image::where('id', $id)->delete();
        return Redirect::back()->with('successMsg', 'Image has been deleted successfully');
    }

    public function deleteVid($id){
        Video::where('id', $id)->delete();
        return Redirect::back()->with('successMsg', 'Video has been deleted successfully');
    }

    public function deleteComment($id){
        Comment::where('id', $id)->delete();
        return Redirect::back()->with('successMsg', 'Comment has been deleted successfully');
    }

    public function viewUserComments($id){
        return View::make('admin.commentsByUser')->with('user', User::where('id', $id)->first());
    }

    public function bgImage(){
        return View::make('admin.bgImage')->with('images', Image::where('title', '_SITEBG')->get());
    }

    public function uploadBgImg(){
        $files = Input::file('bgImg');

        if(isset($files)){
            foreach($files as $file){
                if($file->getClientOriginalExtension() != 'jpg'){
                    return Redirect::back('errorMsg', 'Upload only accepts .jpg images');
                }
            }

            foreach($files as $file) {
                $newFileName = Image::where('title', '_SITEBG')->count()+1;
                // validating each file.
                $rules = array('file' => 'required|mimes:png,jpeg,jpg'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
                $validator = Validator::make(array('file'=> $file), $rules);
                if($validator->passes()){
                    // path is root/uploads
                    $destinationPath = 'public/uploadBGimg';
                    $filename = $newFileName.'.'.$file->getClientOriginalExtension();
                    $upload_success = $file->move($destinationPath, $filename);

                    // insert table the details
                    Image::insert(array(
                        'user_id'   =>  Auth::user()->id,
                        'path'      =>  '/uploadBGimg/'.$filename,
                        'title'     =>  '_SITEBG',
                        'description'   =>  'Enter new description',
                    ));
                }
                else {
                    return Redirect::back()->with('errorMsg', 'Please choose a file before submitting.');
                }
            }
        }else{
            return Redirect::back()->with('errorMsg', 'Please choose a file before submitting.');
        }
        return Redirect::back()->with('successMsg', 'Upload is successful');
    }

    public function manageBgImg(){
        return View::make('admin.manageBgImg')->with('images', Image::where('title', '_SITEBG')->get());
    }
}
