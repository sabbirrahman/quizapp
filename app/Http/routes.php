<?php

Route::get('/',			'PageController@index'  );
//Route::get('/admin', 	'PageController@admin'  );
//Route::get('/student',  'PageController@student');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
Route::controllers([
    'password' => 'Auth\PasswordController',
]);

Route::get('admin', [
	'as' => 'admin',
	'uses' => 'PageController@admin',
	'middleware' => 'admin'
]);

Route::get('student', [
	'as' => 'student',
	'uses' => 'PageController@student',
	'middleware' => 'student'
]);