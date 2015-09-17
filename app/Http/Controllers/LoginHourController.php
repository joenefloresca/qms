<?php namespace App\Http\Controllers;

use \App\Http\Models\LoginHour;
use Input;
use DB;

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
		$this->middleware('admin');
		return view('loginhours.index');
	}

	public function getLoginHoursAll()
	{
		$data = new LoginHour();
		return json_encode($data->getLoginHours());
	}

	public function getLoginHoursFilter()
	{
		$from = Input::get("from");
		$to   = Input::get("to");

		$query = "SELECT a.id, a.date, a.status, b.name, a.loginhours, a.created_at, a.lastlogout FROM loginhours a INNER JOIN users b ON a.user_id = b.id WHERE a.created_at >= '$from' AND a.created_at <= '$to'";
		$data = DB::connection('pgsql')->select($query);
		return json_encode($data);	
	}

	
	


}
