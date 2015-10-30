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
Route::get('api/loginhours/filter', 'LoginHourController@getLoginHoursFilter');

/* Customers Resource Route*/
Route::resource('customer', 'CustomerController');

/* Customers Upload CSV Route*/
Route::get('customer-upload', 'CustomerController@getUploadCsv');
Route::post('customer-upload', 'CustomerController@postUploadCsv');

/* Customer Ajax Calls */
Route::get('api/customer/all', 'CustomerController@apiGetCustomers');
Route::get('crm/api/customer/number', 'CustomerController@apiGetByNumber');


/* Reports Routes */
Route::get('reports/detailedsummary', 'ReportController@showDetailedSummary');
Route::get('reports/agentperformance', 'ReportController@showAgentPerformance');
Route::get('reports/agentperformancenet', 'ReportController@showAgentPerformanceNet');
Route::get('reports/charityresponses', 'ReportController@showCharityResponses');
Route::get('reports/charityresponsesnet', 'ReportController@showCharityResponsesNet');
Route::get('reports/verifierreport', 'ReportController@showVerifierReport');
Route::get('reports/dailyverifierreport', 'ReportController@showDailyVerifierReport');
Route::get('reports/qasummary', 'ReportController@showQaSummaryReport');
Route::get('reports/campaigngrossperformance', 'ReportController@showCampaignGross');
Route::get('reports/campaignnetperformance', 'ReportController@showCampaignNet');

/* Reports Ajax Calls */
Route::get('reports/api/crm/detailedsummary', 'ReportController@apidetailedsummary');
Route::get('reports/api/crm/agentperformance', 'ReportController@apiagentperformance');
Route::get('reports/api/crm/agentperformancenet', 'ReportController@apiagentperformancenet');
Route::get('reports/api/crm/apicampaigngrossperformance', 'ReportController@apicampaigngrossperformance');
Route::get('reports/api/crm/apiCampaignNetPerformance', 'ReportController@apicampaignnetperformance');
Route::get('reports/api/crm/charityresponses', 'ReportController@apicharityresponses');
Route::get('reports/api/crm/charityresponsesnet', 'ReportController@apicharityresponsesnet');
Route::get('reports/api/crm/verifierreport', 'ReportController@apiverifierreport');
Route::get('reports/api/crm/dailyverifierreport', 'ReportController@apidailyverifierreport');
Route::get('reports/api/crm/qasummary', 'ReportController@apiqasummary');
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
Route::get('qa/api/crm/all2', 'QaController@getCrmList2'); // Verify List with Date Range
Route::get('qa/api/crm/reverify', 'QaController@getCrmReverify');
Route::get('qa/api/crm/reverify2', 'QaController@getCrmReverify2');
Route::get('qa/verify/qa/api/crm/getquestion', 'QaController@getQuestionCplResponse');
Route::get('qa/reverify/qa/api/crm/getquestion', 'QaController@getQuestionCplResponse');

/* Users / Agents Routes */
Route::get('crm/api/agent/loginhours', 'UserController@getAgentLoginHours');
Route::get('crm/api/agent/loginhourslive', 'UserController@getAgentLoginHoursLive');
Route::get('crm/api/agent/daygross', 'UserController@getAgentDayGross');
Route::get('crm/api/agent/completedsurvey', 'UserController@getAgentCompletedSurvey');
Route::get('crm/api/agent/partialsurvey', 'UserController@getAgentPartialSurvey');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
