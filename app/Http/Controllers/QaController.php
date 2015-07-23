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

}
