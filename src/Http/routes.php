<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function () {
 	 Route::controllers([
			'auth' => 'Knock\Http\Controllers\Auth\AuthController',
			'password' => 'Knock\Http\Controllers\Auth\PasswordController',
	]);  

 	 Route::post('/users/data', 'Knock\Http\Controllers\UsersController@getUserData');
 	 Route::post('/knock/tags/data', 'Knock\Http\Controllers\TagsController@getTagData');
 	 	
	Route::get('/knock', function () {
		return view('knock::welcome');
	});
	

	Route::get('/knock/home', ['middleware' => 'knock', function () {
		return view('knock::home');
	}]);
		
	Route::resource('knock/tags', 'Knock\Http\Controllers\TagsController');
	Route::resource('knock/tags.roles', 'Knock\Http\Controllers\RolesController');
	Route::resource('knock/tags.roles.actions', 'Knock\Http\Controllers\ActionsController');
	Route::resource('knock/events', 'Knock\Http\Controllers\AuditController');
	Route::resource('users', 'Knock\Http\Controllers\UsersController');
	
	Route::get('/login', 'Knock\Http\Controllers\Auth\AuthController@getLogin');
	Route::get('/register', 'Knock\Http\Controllers\Auth\AuthController@getRegister');
	Route::post('/register', 'Knock\Http\Controllers\Auth\AuthController@postRegister');
	Route::get('/logout', 'Knock\Http\Controllers\Auth\AuthController@logout');
	Route::post('event-list', 'Knock\Http\Controllers\AuditController@getList');
	
	

    });
