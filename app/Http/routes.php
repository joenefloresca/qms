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

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
});

/* Questions Resource Controller*/
Route::resource('question', 'QuestionController');

/* Questions API Calls */
Route::get('api/question/all', 'QuestionController@apiGetQuestions');

Route::get('api/sort/questions', 'QuestionController@apiSortQuestions');

/* ColumnHeader Resource Controller*/
Route::resource('column', 'ColumnController');

/* ColumnHeader API Calls */
Route::get('api/column/all', 'ColumnController@apiGetColumns');

/* CRM Resource Controller*/
Route::resource('crm', 'CrmController');


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
