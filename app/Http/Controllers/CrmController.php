<?php namespace App\Http\Controllers;

use Validator;
use Input;
use Redirect;
use Session;
use View;
use \App\Http\Models\Question;
use DB;

class CrmController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	// public function __construct()
	// {
	// 	$this->middleware('auth');
	// }

	public function index()
	{
		return view('crm.index');
	}

	public function create()
	{
        $questions = Question::where('isenabled', '=', 'Yes')->orderBy('sortorder', 'asc')->get();
    
		return view('crm.create')->with(array('questions' => $questions));
	}


}
