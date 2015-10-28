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

Route::get('/',			'PageController@index'  );
//Route::get('/admin', 	'PageController@admin'  );
//Route::get('/student',  'PageController@student');

Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
Route::controllers([
    'password' => 'Auth\PasswordController',
]);

Route::get('admin', [
	'as' => 'admin',
	'uses' => 'PageController@admin',
	'middleware' => 'admin'
]);

Route::get('student', [
	'as' => 'studnet',
	'uses' => 'PageController@studnet',
	'middleware' => 'studnet'
]);