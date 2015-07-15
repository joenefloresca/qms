<?php namespace App\Http\Controllers;

use Validator;
use Input;
use Redirect;
use Session;
use View;
use \App\Http\Models\Question;
use \App\Http\Models\Column;
use \App\Http\Models\External;
use DB;

class ColumnController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function apiGetColumns()
	{
		$col = Column::orderBy('id', 'DESC')->get();
		return json_encode($col);
	}

	public function index()
	{
		return view('column.index');
	}

	public function create()
	{
		return view('column.create');
	}

	public function store()
	{
		/* Get Column Header Value */
		$header = Input::get('ColumnHeader');
		$method = Input::get('Method');
		$selected = array();

		/* Get Selected database */
		if(!empty(Input::get('UKSurvey1_General')))
		{
		array_push($selected,"UKSurvey1_General");
		}
		if(!empty(Input::get('UKSurvey1_MCS')))
		{
		array_push($selected,"UKSurvey1_MCS");
		}
		if(!empty(Input::get('UKSurvey2_General')))
		{
		array_push($selected,"UKSurvey2_General");
		}
		if(!empty(Input::get('UKSurvey2_MCS')))
		{
		array_push($selected,"UKSurvey2_MCS");
		}
		if(!empty(Input::get('MCSSurvey_Main')))
		{
		array_push($selected,"MCSSurvey_Main");
		}
		if(!empty(Input::get('HSG_Survey')))
		{
		array_push($selected,"HSG_Survey");
		}
		if(!empty(Input::get('MCSSurvey_NTG')))
		{
		array_push($selected,"MCSSurvey_NTG");
		}
		if(!empty(Input::get('UKSurvey_Express')))
		{
		array_push($selected,"UKSurvey_Express");
		}
		if(!empty(Input::get('pgsql')))
		{
		array_push($selected,"pgsql");
		}

        Validator::extend('unique_multiple', function ($attribute, $value, $parameters)
        {
            // Get table name from first parameter
            $table = array_shift($parameters);

            // Build the query
            $query = DB::table($table);
            // Add the field conditions
            foreach ($parameters as $i => $field)
                $query->where($field, $value[$i]);
                $query->where('method', 'ADD');
   

            // Validation result will be false if any rows match the combination
            return ($query->count() == 0);
        });

        foreach ($selected as $key => $value) 
    	{
    		$messages = array(
            	'unique_multiple' => 'Sorry, This Column Header as been added to database: . '.$value,
        	);

			$validator = Validator::make(
	            // Validator data goes here
	            array(
	                'unique_fields' => array($header, $value),
	            ),
	            // Validator rules go here
	            array(
	                'unique_fields' => 'unique_multiple:columns,column_header,database',
	            
	            ),
	            $messages
        	);

        	if($method == "DROP")
			{
				$external = new External();
 				$external->createHeader($header, $value, $method);

 				/* Record deleted Column Header Name */
				$col = new Column();
				$col->column_header = $header;
				$col->database = $value;
				$col->method = $method;
				$col->save();

				/* Deleted Record with Add method so that it can be added again */
				$col->deleteFromRecord($header, 'ADD', $value);

			}
			else if($method == "ADD")
			{
				if ($validator->fails()) 
		        {

		            return Redirect::to('column/create')->withErrors($validator);
		        }
		        else
		        {
		        	$external = new External();
	 				$external->createHeader($header, $value, $method);

	 				/* Record added Column Header Name */
					$col = new Column();
					$col->column_header = $header;
					$col->database = $value;
					$col->method = $method;
					$col->save();
		        }
			}
        	

		}

		if($method == "DROP")
		{
			Session::flash('alert-success', 'Column Header DELETED Successfully.');
		}
		else if($method == "ADD")
		{
			Session::flash('alert-success', 'Column Header ADDED Successfully.');
		}

        return Redirect::to('column/create');

	}


}
