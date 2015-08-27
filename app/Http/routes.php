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

/* Questions Resource Route*/
Route::resource('question', 'QuestionController');

/* Questions Ajax Calls */
Route::get('api/question/all', 'QuestionController@apiGetQuestions');

Route::get('api/sort/questions', 'QuestionController@apiSortQuestions');

Route::get('api/question/changeenable', 'QuestionController@apiQuestionChangeEnable');

Route::get('crm/api/questions/childcount', 'QuestionController@apiQuestionChildCount');

Route::get('crm/api/questions/childresponse', 'QuestionController@apiQuestionChildResponse');

Route::get('crm/api/questions/childsort', 'QuestionController@apiQuestionChildSort');

Route::get('crm/api/questions/checkchild', 'QuestionController@apiQuestionChildCheck');

Route::get('crm/api/questions/getallactive', 'QuestionController@apiQuestionGetActive');

/* ColumnHeader Resource Route*/
Route::resource('column', 'ColumnController');

/* ColumnHeader Ajax Calls */
Route::get('api/column/all', 'ColumnController@apiGetColumns');

/* CRM Resource Route*/
Route::resource('crm', 'CrmController');

/* Login Hours Resource Route*/
Route::resource('loginhours', 'LoginHourController');

/* Login Hours Ajax Calls */
Route::get('api/loginhours/all', 'LoginHourController@getLoginHoursAll');

/* Customers Resource Route*/
Route::resource('customer', 'CustomerController');

/* Customers Upload CSV Route*/
Route::get('customer-upload', 'CustomerController@getUploadCsv');
Route::post('customer-upload', 'CustomerController@postUploadCsv');

/* Customer Ajax Calls */
Route::get('api/customer/all', 'CustomerController@apiGetCustomers');
Route::get('crm/api/customer/number', 'CustomerController@apiGetByNumber');


/* Reports Routes */
Route::get('reports/agentperformance', 'ReportController@agentperformance');
Route::get('reports/charityresponses', 'ReportController@charityresponses');
Route::get('reports/verifierreport', 'ReportController@showVerifierReport');
Route::get('reports/qasummary', 'ReportController@showQaSummaryReport');

/* Reports Ajax Calls */
Route::get('reports/api/crm/agentperformance', 'ReportController@apiagentperformance');
Route::get('reports/api/crm/charityresponses', 'ReportController@apicharityresponses');
Route::get('reports/api/crm/charityresponses', 'ReportController@apicharityresponses');
Route::get('reports/api/crm/verifierreport', 'ReportController@apiverifierreport');
Route::get('reports/api/crm/qasummary', 'ReportController@apiqasummary');
Route::get('reports/api/crm/qasummary2', 'ReportController@apiqasummary2');
Route::get('reports/api/crm/qasummary2', 'ReportController@apiqasummary2');
Route::get('reports/api/crm/getqaresponses/{qaform_id}', 'ReportController@apigetqaresponses');
Route::get('api/crm/charityresponsesall', 'ReportController@apicharityresponsesall');


/* QA Tools / Modules Routes*/
Route::get('qa/verifylist', 'QaController@verifylist');
Route::get('qa/verify/{crmid}', 'QaController@showVerifyForm');
Route::post('qa/postverify/{crmid}', 'QaController@postVerify');
Route::get('qa/reverify/{crmid}', 'QaController@showReVerifyForm');
Route::get('qa/reverifylist', 'QaController@updateVerifiedForms');
Route::post('qa/postreverify/{crmid}', 'QaController@postReVerify');


/* QA Ajax Calls */
Route::get('qa/api/crm/all', 'QaController@getCrmList');
Route::get('qa/api/crm/reverify', 'QaController@getCrmReverify');

/* Users / Agents Routes */
Route::get('crm/api/agent/loginhours', 'UserController@getAgentLoginHours');
Route::get('crm/api/agent/daygross', 'UserController@getAgentDayGross');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
