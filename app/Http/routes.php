<?php

// Model binding
Route::model('quizzes'  , 'App\Models\Quiz'     );
Route::model('questions', 'App\Models\Question' );
Route::model('options'  , 'App\Models\Option'   );
Route::model('students' , 'App\Models\Student'  );

Route::bind('quizzes', function($value, $route){
	return App\Models\Quiz::whereId($value)->first();
});
Route::bind('questions', function($value, $route){
	return App\Models\Question::whereId($value)->first();
});
Route::bind('options', function($value, $route){
	return App\Models\Option::whereId($value)->first();
});
Route::bind('students', function($value, $route){
	return App\Models\Student::whereId($value)->first();
});


// Pages Routes
Route::get('/', 'PageController@index');
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


// Authentication Routes...
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');


// Registration Routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
Route::controllers(['password' => 'Auth\PasswordController']);


// Admin APIs
Route::group(['prefix' => 'api/admin/', 'middleware' => 'admin'], function(){

	// Quiz
	Route::resource('quizzes', 					 'QuizController', ['except' => ['create', 'edit']]);
	Route::get('quizzes/{quizzes}/participants', 'QuizController@participants');
	
	// Question of Quiz
	Route::resource('quizzes.questions', 'QuestionController', ['except' => ['create', 'edit']]);
	
	// Option of Quiz
	Route::resource('questions.options', 'OptionController', ['only' => ['store', 'update', 'destroy']]);
	
	// Student
	Route::resource('students', 			  'StudentController', ['except' => ['create', 'edit']]);
	Route::get('students/{students}/quizzes', 'StudentController@quizzes');

});

// Student APIs
Route::group(['prefix' => 'api/student/', 'middleware' => 'student'], function(){
	
	// Quiz
	Route::resource('quizzes', 'QuizController', ['only' => ['index', 'show']]);
	Route::get('quizzes/{quizzes}/participate/{students}', 'QuizController@participate');
	
	// Question of Quiz
	Route::resource('quizzes.questions', 'QuestionController', ['only' => ['index', 'show']]);
	
	// Answer of Quiz
	Route::resource('quizzes.answers'					, 'AnswerController'  , ['only' => ['index', 'store']]);
	Route::resource('quizzes/{quizzes}/correctanswers'  , 'AnswerController@correctAnswers');

	// Student
	Route::resource('students'						, 'StudentController', ['only' => ['show']]);
	Route::get('students/{students}/quizzes'		, 'StudentController@quizzes');
	Route::get('students/{students}/score/{quizzes}', 'StudentController@score');

});
