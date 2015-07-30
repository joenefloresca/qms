<?php namespace App\Http\Controllers;

use DB;
use Input;

class ReportController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{	
		$this->middleware('auth');
	}


	public function agentperformance()
	{
		return view('reports.agentperformance');
	}

	public function charityresponses()
	{
		return view('reports.charityresponses');
	}

	public function apiagentperformance()
	{
		$from = Input::get("from");
		$to   = Input::get("to");

		$query = "SELECT a.agent_id, c.name, a.TotalApplication, b.TotalLoginHours
				     , b.TotalLoginHours / a.TotalApplication as ApplicationPerHour
				     , 1.75 * (b.TotalLoginHours / a.TotalApplication) as RPH
				FROM (
				    SELECT a.agent_id as agent_id
				         , COUNT(a.id) as TotalApplication
				    FROM forms a
				    WHERE  a.created_at >= '$from' AND a.created_at <= '$to'
				    GROUP BY a.agent_id
				 ) AS a
				 join (
				     SELECT b.user_id as agent_id
				          , SUM(b.loginhours) as TotalLoginHours
				     FROM loginhours b 
				     WHERE  created_at >= '$from' AND created_at <= '$to'
				     GROUP BY b.user_id
				 ) as b 
				     ON a.agent_id = b.agent_id
				 INNER JOIN users c ON c.id = a.agent_id    
				 ; ";	        
		$data = DB::connection('pgsql')->select($query);
		return json_encode($data);
	}

	public function apicharityresponses()
	{
		$from = Input::get("from");
		$to   = Input::get("to");

		$query = "SELECT question_id, q.columnheader, ct_yes, ct_no, ct_maybe, q.costperlead, q.costperlead * (r.ct_yes + r.ct_maybe) AS revenue
				FROM  (
				   SELECT question_id
				        , count(response = 'Yes' OR NULL) AS ct_yes
				        , count(response = 'No' OR NULL) AS ct_no
				        , count(response = 'Possbily' OR NULL) AS ct_maybe
				   FROM   responses
				   WHERE  created_at >= '$from' AND created_at <= '$to'
				   GROUP  BY 1
				   ) r
				JOIN questions q ON q.id = r.question_id;";
		$data = DB::connection('pgsql')->select($query);
		return json_encode($data);		
	}

	public function apicharityresponsesall()
	{
		$query = "SELECT q.columnheader, q.costperlead * (r.ct_yes + r.ct_maybe) AS revenue
				FROM  (
				   SELECT question_id
				        , count(response = 'Yes' OR NULL) AS ct_yes
				        , count(response = 'No' OR NULL) AS ct_no
				        , count(response = 'Possbily' OR NULL) AS ct_maybe
				   FROM   responses
				   GROUP  BY 1
				   ) r
				JOIN questions q ON q.id = r.question_id;";

		$data = DB::connection('pgsql')->select($query);
		return json_encode($data);	
	}

	public function showVerifierReport()
	{
		$qa_names = array('All' => 'All') + DB::table('users')->where(array('isAdmin' => 1))->lists('name','id');
		return view('reports.verifierreport')->with(array('qa_names' => $qa_names));
	}

	public function apiverifierreport()
	{
		$from    = Input::get("from");
		$to      = Input::get("to");
		$qa_name = Input::get("qa_name");


		if($qa_name == "All")
		{
			$query = "SELECT verifier_id, verified_by,
				COUNT(verified_status = 'Passed' OR NULL) AS passed, 
				COUNT(verified_status = 'Passed-Approved' OR NULL) AS passed_approved,
				COUNT(verified_status = 'Passed-With Changes' OR NULL) AS passed_changes,
				COUNT(verified_status = 'Passed-Unverified' OR NULL) AS passed_unverified,
				COUNT(verified_status = 'Pending' OR NULL) AS pending,
				COUNT(verified_status = 'Reject A' OR NULL) AS reject_a,
				COUNT(verified_status = 'Reject B' OR NULL) AS reject_b,
				COUNT(verified_status = 'Reject C' OR NULL) AS reject_c
				FROM qa_forms WHERE created_at >= '$from' AND created_at <= '$to'
				GROUP BY verifier_id, verified_by;";
		}
		else
		{
			$query = "SELECT verifier_id, verified_by,
				COUNT(verified_status = 'Passed' OR NULL) AS passed, 
				COUNT(verified_status = 'Passed-Approved' OR NULL) AS passed_approved,
				COUNT(verified_status = 'Passed-With Changes' OR NULL) AS passed_changes,
				COUNT(verified_status = 'Passed-Unverified' OR NULL) AS passed_unverified,
				COUNT(verified_status = 'Pending' OR NULL) AS pending,
				COUNT(verified_status = 'Reject A' OR NULL) AS reject_a,
				COUNT(verified_status = 'Reject B' OR NULL) AS reject_b,
				COUNT(verified_status = 'Reject C' OR NULL) AS reject_c
				FROM qa_forms WHERE created_at >= '$from' AND created_at <= '$to' AND verifier_id = '$qa_name'
				GROUP BY verifier_id, verified_by;";
		}

		
		$data = DB::connection('pgsql')->select($query);
		return json_encode($data);		
	}



	

	
	


}
