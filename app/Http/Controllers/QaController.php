<?php namespace App\Http\Controllers;

use Validator;
use Input;
use Redirect;
use Session;
use View;
use \App\Http\Models\Crm;
use \App\Http\Models\Response;

class QaController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
        $this->middleware('auth');
	}

    public function verifylist()
    {
        $this->middleware('admin');
        return view('qa.verifylist');
    }

    public function getCrmList()
    {
        $crm = new Crm();
        return json_encode($crm->getCrmList());
    }

    public function showVerifyForm($crmid)
    {
        $this->middleware('admin');
        $crm = Crm::find($crmid);
        $responses = new Response();
        return View::make('qa.verifyform')->with(array('crm' => $crm, 'responses' => $responses->getResponsesByCrmId($crmid)));
    }

    public function postVerify()
    {
        $rules = array(
            'title'          => 'required',
            'firstname'      => 'required',
            'lastname'       => 'required',
            'addr1'          => 'required',
            'addr2'          => 'required',
            'addr3'          => 'required',
            'addr4'          => 'required',
            'town'           => 'required',
            'country'        => 'required',
            'postcode'       => 'required',
            'phone_num'      => 'required',
            'phonetype'      => 'required',
            'age_bracket'    => 'required',
            'age_bracket'    => 'required',
            'work_status'    => 'required',
            'home_status'    => 'required',
            'marital_status' => 'required',
        );
        
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) 
        {
            return Redirect::to('qa/verify/'.Input::get("id"))->withErrors($validator);
        }
    }

}
