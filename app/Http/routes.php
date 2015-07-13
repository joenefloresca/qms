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

Route::get('api/question/changeenable', 'QuestionController@apiQuestionChangeEnable');

/* ColumnHeader Resource Controller*/
Route::resource('column', 'ColumnController');

/* ColumnHeader API Calls */
Route::get('api/column/all', 'ColumnController@apiGetColumns');

/* CRM Resource Controller*/
Route::resource('crm', 'CrmController');

/* Login Hours Resource Controller*/
Route::resource('loginhours', 'LoginHourController');

/* Login Hours API Calls */
Route::get('api/loginhours/all', 'LoginHourController@getLoginHoursAll');

/* Customers Resource Controller*/
Route::resource('customer', 'CustomerController');

/* Customers Upload CSV Controller*/
Route::get('customer-upload', 'CustomerController@getUploadCsv');
Route::post('customer-upload', 'CustomerController@postUploadCsv');

/* Customer API Calls */
Route::get('api/customer/all', 'CustomerController@apiGetCustomers');
Route::get('crm/api/customer/number', 'CustomerController@apiGetByNumber');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
