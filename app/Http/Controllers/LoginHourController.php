<?php namespace App\Http\Controllers;

use \App\Http\Models\LoginHour;

class LoginHourController extends Controller {

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
		return view('loginhours.index');
	}

	public function getLoginHoursAll()
	{
		$data = new LoginHour();
		return json_encode($data->getLoginHours());
	}

	
	


}
