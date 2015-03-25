<?php

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

Route::get('/', function()
{
	return View::make('hello');
});

// WEBSITE ROUTES -- START
Route::get('/', 'WebMainController@index');
// WEBSITE ROUTES -- END

// ADMIN ROUTES -- START
Route::get('/admin/', 'AdminController@index');
Route::get('/admin/login', 'AdminController@index');
Route::post('/admin/doLogin', 'AdminController@doLogin');
Route::get('/admin/logout', 'AdminController@logout');

Route::group(array('before' => 'auth'), function(){
    Route::get('/admin/home', 'AdminController@home');
    Route::get('/admin/users', 'AdminController@users');
    Route::get('/admin/deactivate/{id}', 'AdminController@deactivate');
    Route::get('/admin/activate/{id}', 'AdminController@activate');
});

// ADMIN ROUTES -- END

// THIS FUNCTION IS FOR ROUTE PROTECTION - IT REDIRECTS THE SYSTEM WHEN THE ROUTE/METHOD IS NOT FOUND AND/OR DOESN'T EXIST - Jan Sarmiento
App::missing(function(){
    return View::make('Route404');
});