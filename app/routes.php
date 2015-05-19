<?php
// REMINDERS - By Jan Sarmiento
//    on the php folder>file php.ini uncomment the extension=php_fileinfo.dll line
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// WEBSITE ROUTES -- START
Route::group(array('before' => 'DESTROY-ADMIN'), function(){
    Route::get('/', 'WebMainController@index');
    Route::get('/home', 'WebMainController@index');
    Route::get('/gallery', 'WebMainController@gallery');
    Route::get('/about', 'WebMainController@about');
    Route::get('/contactus', 'WebMainController@contactus');
    Route::get('/doLogout', 'WebMainController@doLogout');
    Route::post('/doLogin', 'WebMainController@doLogin');
    Route::post('/doRegister', 'WebMainController@doRegister');
    Route::get('/getArticle/{id}', 'WebMainController@getArticle');
    Route::get('/deleteComment/{id}', 'WebMainController@deleteComment');
});

Route::group(array('before' => 'ROUTE-PROTECT'), function(){
    Route::get('/login', 'WebMainController@login');
    Route::get('/register', 'WebMainController@register');
    Route::post('/postComment/{locid}/{userid}', 'WebMainController@postComment');
    Route::post('/changePass', 'WebMainController@changePass');
    Route::post('/changeEmail', 'WebMainController@changeEmail');
    Route::post('/changeEmail', 'WebMainController@changeEmail');
});
// WEBSITE ROUTES -- END

// ADMIN ROUTES -- START

Route::group(array('before' => 'DESTROY-USER'), function(){
    Route::get('/admin/', 'AdminController@index');
    Route::get('/admin/login', 'AdminController@index');
    Route::post('/admin/doLogin', 'AdminController@doLogin');
    Route::get('/admin/logout', 'AdminController@logout');
});

Route::group(array('before' => 'ADMIN'), function(){
    Route::get('/admin/home', 'AdminController@promotions');
    Route::get('/admin/users', 'AdminController@users');
    Route::get('/admin/deactivate/{id}', 'AdminController@deactivate');
    Route::get('/admin/activate/{id}', 'AdminController@activate');
    Route::get('/admin/profile/{id}', 'AdminController@profile');
    Route::post('/admin/changepass/{id}', 'AdminController@changepass');
    Route::get('/admin/comments', 'AdminController@comments');
    Route::get('/admin/userComments', 'AdminController@userComments');
    Route::get('/admin/images', 'AdminController@images');
    Route::get('/admin/videos', 'AdminController@videos');
    Route::post('/admin/upload/{id}', 'AdminController@upload');
    Route::get('/admin/general', 'AdminController@general');
    Route::get('/admin/preview/aboutus', 'AdminController@previewAboutus');
    Route::get('/admin/homeManage', 'AdminController@homeManage');
    Route::get('/admin/contactus', 'AdminController@contactus');
    Route::post('/admin/updateAboutus', 'AdminController@updateAboutus');
    Route::post('/admin/updateSlogan', 'AdminController@updateSlogan');
    Route::post('/admin/updateHomeslogan', 'AdminController@updateHomeslogan');
    Route::get('/admin/deleteAboutus', 'AdminController@deleteAboutus');
    Route::get('/admin/deleteSlogan', 'AdminController@deleteSlogan');
    Route::get('/admin/deleteHomeslogan', 'AdminController@deleteHomeslogan');
    Route::get('/admin/promotions', 'AdminController@promotions');
    Route::post('/admin/addLocation', 'AdminController@addLocation');
    Route::post('/admin/editLocation', 'AdminController@editLocation');
    Route::get('/admin/article/{id}', 'AdminController@article');
    Route::get('/admin/deleteArticle_{artid}', 'AdminController@deleteArticle');
    Route::post('/admin/addArticle', 'AdminController@addArticle');
    Route::get('/admin/deleteLocation/{id}', 'AdminController@deleteLocation');
    Route::post('/admin/editArticle', 'AdminController@editArticle');
    Route::post('/admin/uploadArticleImage/{id}', 'AdminController@uploadArticleImage');
    Route::post('/admin/addVideo/{id}', 'AdminController@addVideo');
    Route::post('/admin/addVideoFile/{id}', 'AdminController@addVideoFile');
    Route::get('/admin/manageMedia/{id}', 'AdminController@manageMedia');
    Route::get('/admin/deleteImage/{id}', 'AdminController@deleteImage');
    Route::get('/admin/deleteVid/{id}', 'AdminController@deleteVid');
    Route::get('/admin/deleteComment/{id}', 'AdminController@deleteComment');
    Route::get('/viewUserComments/{id}', 'AdminController@viewUserComments');
    Route::get('/admin/bgImage', 'AdminController@bgImage');
    Route::post('/admin/uploadBgImg', 'AdminController@uploadBgImg');
    Route::get('/admin/manageBgImg', 'AdminController@manageBgImg');
    Route::get('/admin/searchUsers', 'AdminController@searchUsers');
    Route::post('/admin/searchUsers', 'AdminController@doSearchUsers');
    Route::get('/admin/auditTrail', 'AdminController@auditTrail');
    Route::post('/admin/auditTrailSearch', 'AdminController@auditTrailSearch');
    Route::get('/viewAudit={userid}', 'AdminController@viewAudit');
    Route::get('/admin/searchAudit/1DATE/{date}/{userid}', 'AdminController@searchAudit1Date');
    Route::get('/admin/searchAudit/2DATE/{date1}/{date2}/{userid}', 'AdminController@searchAudit2Date');
});

// ADMIN ROUTES -- END

// THIS FUNCTION IS FOR ROUTE PROTECTION - IT REDIRECTS THE SYSTEM WHEN THE ROUTE/METHOD IS NOT FOUND AND/OR DOESN'T EXIST - Jan Sarmiento
//App::missing(function(){
//    return View::make('Route404');
//});

//App::error(function(){
//    return View::make('Route500');
//});