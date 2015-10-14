<?php namespace App\Http\Controllers;

use Validator;
use Input;
use Redirect;
use Session;
use View;
use \App\Http\Models\Question;
use \App\Http\Models\Crm;
use \App\Http\Models\Response;
use DB;
use Request;
use Auth;

class CrmController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		return view('crm.index');
	}

	public function create()
	{
		if(Auth::user()->isAdmin == 0 || Auth::user()->isAdmin == 1 || Auth::user()->isAdmin == 2 || Auth::user()->isAdmin == 4)
		{
			$questions = Question::where('isenabled', '=', 'Yes')->orderBy('sortorder', 'asc')->get();
			return view('crm.create')->with(array('questions' => $questions));
		}
		else
		{
			return Response::view('errors.404', array(), 404);
		}
	}

	public function store()
	{
		$rules = array(
            'CrmDisposition'           => 'required',
            'CrmIsUKPermanentResident' => 'required',
            'CrmIsUKPermanentResident' => 'required',
			'phone_num' 		       => 'required|unique:forms'           
        );

        $validator = Validator::make(Input::all(), $rules);


        // Check if all fields is filled
        if ($validator->fails()) 
        {
            return Redirect::to('crm/create')->withInput()->withErrors($validator);
        }
        else
        {

        	$CrmAddr2 = (!empty(Input::get("CrmAddr2")  && Input::get("CrmAddr2") != 'NULL') ? Input::get("CrmAddr2") : '' );
        	$CrmAddr3 = (!empty(Input::get("CrmAddr3") && Input::get("CrmAddr3") != 'NULL') ? Input::get("CrmAddr3") : '' );
        	$CrmAddr4 = (!empty(Input::get("CrmAddr4")  && Input::get("CrmAddr4")  != 'NULL') ? Input::get("CrmAddr4") : '' );
        	$CrmTown = (!empty(Input::get("CrmTown")  && Input::get("CrmTown")  != 'NULL') ? Input::get("CrmTown") : '' );
        	$CrmCountry = (!empty(Input::get("CrmCountry")  && Input::get("CrmCountry")  != 'NULL') ? Input::get("CrmCountry") : '' );

        	$CrmDisposition           = Input::get("CrmDisposition");
			$CRMGross                 = Input::get("CRMGross");
			$CrmIsUKPermanentResident = Input::get("CrmIsUKPermanentResident");
			$CRMPostcode 			  = Input::get("CRMPostcode");
			$CrmAddr1 			  	  = Input::get("CrmAddr1");
			//$CrmAddr2 			  	  = Input::get("CrmAddr2");
			//$CrmAddr3 			  	  = Input::get("CrmAddr3");
			//$CrmAddr4 			  	  = Input::get("CrmAddr4");
			//$CrmTown 			  	  = Input::get("CrmTown");
			//$CrmCountry 			  = Input::get("CrmCountry");
			$Title 			          = Input::get("Title");
			$Gender 			      = Input::get("Gender");
			$CrmFirstName 		  	  = Input::get("CrmFirstName");
			$CrmSurname 			  = Input::get("CrmSurname");
			$CRMTelephoneOptions      = Input::get("CRMTelephoneOptions");
			$CRMTelephoneNo           = Input::get("phone_num");
			$CrmAge                   = Input::get("CrmAge");
			$CRMWorkStatus            = Input::get("CRMWorkStatus");
			$CRMOwnHomeOptions        = Input::get("CRMOwnHomeOptions");
			$CRMMaritalStatus         = Input::get("CRMMaritalStatus");
			$customer_id              = Input::get("customer_id");

			$crm = new Crm();
			$crm->disposition         = $CrmDisposition;
			$crm->gross               = $CRMGross;
			$crm->ispermanentresident = $CrmIsUKPermanentResident;
			$crm->postcode            = $CRMPostcode;
			$crm->addr1               = $CrmAddr1;
			$crm->addr2               = $CrmAddr2;
			$crm->addr3               = $CrmAddr3;
			$crm->addr4               = $CrmAddr4;
			$crm->town                = $CrmTown;
			$crm->country             = $CrmCountry;
			$crm->title               = $Title;
			$crm->gender              = $Gender;
			$crm->firstname           = $CrmFirstName;
			$crm->surname             = $CrmSurname;
			$crm->phonetype           = $CRMTelephoneOptions;
			$crm->phone_num           = $CRMTelephoneNo;
			$crm->age_bracket         = $CrmAge;
			$crm->work_status         = $CRMWorkStatus;
			$crm->home_status         = $CRMOwnHomeOptions;
			$crm->marital_status      = $CRMMaritalStatus;
			$crm->agent_id      	  = Auth::user()->id;
			$crm->customer_id      	  = $customer_id ;

			if($crm->save())
			{
				$lastInsertId = $crm->id;
				$questions = Question::where('isenabled', '=', 'Yes')->orderBy('sortorder', 'asc')->get();
				$columnheader = "";
				foreach ($questions as $key => $value) 
				{
					$columnheader = $value->columnheader; 
					$id = Question::where('columnheader', '=', $columnheader)->get();

					$responses = new Response();
					$responses->crm_id = $lastInsertId;
					$responses->question_id = $id[0]->id;
					$responses->response = Input::get($columnheader);
					$responses->save();
				}

				Session::flash('alert-info', 'Form and responses has been saved.');
			}
			else
			{
				Session::flash('alert-danger', 'Error saving form.');
			}

			return Redirect::to('crm/create');
        }


	}


}
