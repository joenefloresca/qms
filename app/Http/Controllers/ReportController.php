<?php namespace App\Http\Controllers;

use DB;
use Input;
use Auth;
use App;
use Response;

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


	public function showAgentPerformance()
	{
		if(Auth::user()->isAdmin == 1 || Auth::user()->isAdmin == 2 || Auth::user()->isAdmin == 4)
		{
			return view('reports.agentperformance');
		}
		else
		{
			return Response::view('errors.404', array(), 404);
		}
		
	}

	public function showCharityResponses()
	{
		if(Auth::user()->isAdmin == 1 || Auth::user()->isAdmin == 4)
		{
			return view('reports.charityresponses');
		}
		else
		{
			return Response::view('errors.404', array(), 404);
		}
		
	}

	public function showCharityResponsesNet()
	{
		if(Auth::user()->isAdmin == 1 || Auth::user()->isAdmin == 4)
		{
			return view('reports.charityresponsesnet');
		}
		else
		{
			return Response::view('errors.404', array(), 404);
		}
		
	}

	public function apiagentperformance()
	{
		$from = Input::get("from");
		$to   = Input::get("to");

		// $query = "SELECT a.agent_id, c.name, a.TotalApplication, b.TotalLoginHours
		// 		     , b.TotalLoginHours / a.TotalApplication as ApplicationPerHour
		// 		     , 1.75 * (b.TotalLoginHours / a.TotalApplication) as RPH
		// 		FROM (
		// 		    SELECT a.agent_id as agent_id
		// 		         , COUNT(a.id) as TotalApplication
		// 		    FROM forms a
		// 		    WHERE  a.created_at >= '$from' AND a.created_at <= '$to'
		// 		    GROUP BY a.agent_id
		// 		 ) AS a
		// 		 join (
		// 		     SELECT b.user_id as agent_id
		// 		          , SUM(b.loginhours) as TotalLoginHours
		// 		     FROM loginhours b 
		// 		     WHERE  created_at >= '$from' AND created_at <= '$to'
		// 		     GROUP BY b.user_id
		// 		 ) as b 
		// 		     ON a.agent_id = b.agent_id
		// 		 INNER JOIN users c ON c.id = a.agent_id    
		// 		 ; ";
		$query = "SELECT a.agent_id, c.name, a.completedsurvey, a.partial_survey, b.TotalLoginHours
				     , a.CompletedSurvey + a.partial_survey as ApplicationPerHour
				     , (a.CompletedSurvey * 1.75) + (a.partial_survey * 0.40) as RPH
				FROM (
				    SELECT a.agent_id as agent_id, 
				  COUNT(case when disposition = 'Completed Survey' then a.id end) as completedsurvey, 
          COUNT(case when disposition = 'Partial Survey' then a.id end) as partial_survey
				    FROM forms a
				    WHERE  a.created_at >= '$from' AND a.created_at <= '$to' 
				    GROUP BY a.agent_id
				 ) AS a
				 join (
				     SELECT b.user_id as agent_id
				          , SUM(b.loginhours) as TotalLoginHours
				     FROM loginhours b 
				     WHERE  date >= '$from'::date AND date <= '$to'::date
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
				JOIN questions q ON q.id = r.question_id ORDER BY q.columnheader ASC;";
		$data = DB::connection('pgsql')->select($query);
		return json_encode($data);		
	}

	public function apicharityresponsesnet()
	{
		$from = Input::get("from");
		$to   = Input::get("to");

		// $query = "SELECT question_id, q.columnheader, ct_yes, ct_no, ct_maybe, q.costperlead, q.costperlead * (r.ct_yes + r.ct_maybe) AS revenue
		// 		FROM  (
		// 		   SELECT question_id
		// 		        , count(response = 'Yes' OR NULL) AS ct_yes
		// 		        , count(response = 'No' OR NULL) AS ct_no
		// 		        , count(response = 'Possbily' OR NULL) AS ct_maybe
		// 		   FROM   qa_responses
		// 		   WHERE  created_at >= '$from' AND created_at <= '$to'
		// 		   GROUP  BY 1
		// 		   ) r
		// 		JOIN questions q ON q.id = r.question_id ORDER BY q.columnheader ASC;";
		$query = "SELECT question_id, q.columnheader, ct_yes, ct_no, ct_maybe, q.costperlead, q.costperlead * (r.ct_yes + r.ct_maybe) AS revenue
				FROM  (
				   SELECT question_id
				        , count(response = 'Yes' OR NULL) AS ct_yes
				        , count(response = 'No' OR NULL) AS ct_no
				        , count(response = 'Possbily' OR NULL) AS ct_maybe
				   FROM   qa_responses 
						INNER JOIN qa_forms ON qa_responses.qa_forms_id = qa_forms.id
            INNER JOIN forms ON forms.id = qa_forms.orig_crm_id
				   WHERE  forms.created_at >= '$from' AND forms.created_at <= '$to'
				   GROUP  BY 1
				   ) r
				JOIN questions q ON q.id = r.question_id
        ORDER BY q.columnheader ASC";
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

	public function showDailyVerifierReport()
	{
		return view('reports.dailyverifierreport');
	}

	public function apiverifierreport()
	{
		$from    = Input::get("from");
		$to      = Input::get("to");
		$disposition = Input::get("disposition");

		$disposition_query = "";
		if($disposition != "All")
		{
			$disposition_query = "AND a.disposition = '".$disposition."'";
		}

		$query = "SELECT a.verifier_id, a.verified_by,
			COUNT(a.verified_status = 'Passed' OR NULL) AS passed, 
			COUNT(a.verified_status = 'Passed-Approved' OR NULL) AS passed_approved,
			COUNT(a.verified_status = 'Passed-With Changes' OR NULL) AS passed_changes,
			COUNT(a.verified_status = 'Passed-Unverified' OR NULL) AS passed_unverified,
			COUNT(a.verified_status = 'Pending' OR NULL) AS pending,
			COUNT(a.verified_status = 'Reject A' OR NULL) AS reject_a,
			COUNT(a.verified_status = 'Reject B' OR NULL) AS reject_b,
			COUNT(a.verified_status = 'Reject C' OR NULL) AS reject_c 
			FROM qa_forms a
			WHERE a.created_at >= '$from' AND a.created_at <= '$to' $disposition_query
			GROUP BY a.verifier_id, a.verified_by;";
		
		$data = DB::connection('pgsql')->select($query);
		return json_encode($data);		
	}

	public function apidailyverifierreport()
	{
		$from    = Input::get("from");
		$to      = Input::get("to");
		$disposition = Input::get("disposition");

		$disposition_query = "";
		if($disposition != "All")
		{
			$disposition_query = "AND disposition = '".$disposition."'";
		}

		$query = "SELECT created_at::date AS start_date,
				created_at::date + 1 AS end_date,
				COUNT(verified_status = 'Passed-Approved' OR NULL) AS passed_approved,
				COUNT(verified_status = 'Passed-With Changes' OR NULL) AS passed_changes,
				COUNT(verified_status = 'Passed-Unverified' OR NULL) AS passed_unverified,
				COUNT(verified_status = 'Pending' OR NULL) AS pending,
				COUNT(verified_status = 'Reject A' OR NULL) AS reject_a,
				COUNT(verified_status = 'Reject B' OR NULL) AS reject_b,
				COUNT(verified_status = 'Reject C' OR NULL) AS reject_c, 
				COUNT(verified_status = 'Unverified' OR NULL) AS unverified,
				COUNT(verified_status = 'On The Proccess' OR NULL) AS on_the_process
				FROM qa_forms 
				WHERE created_at >= '$from'::date AND created_at <= '$to'::date $disposition_query
				GROUP BY created_at::date ORDER BY start_date;";
		
		$data = DB::connection('pgsql')->select($query);
		return json_encode($data);		
	}

	public function showQaSummaryReport()
	{
		$agent_name = array('All' => 'All') + DB::table('users')->where(array('isAdmin' => 0))->lists('name','id');
		return view('reports.qasummary')->with(array('agent_name' => $agent_name));
	}

	public function apiqasummary()
	{
		$from           = Input::get("from");
		$to             = Input::get("to");
		$agent          = Input::get("agent");
		$disposition    = Input::get("disposition");
		$verifiedstatus = Input::get("verifiedstatus");
		$dispositionQuery = " AND disposition IN('Completed Survey', 'MCS Record')";
		$verifiedQuery = "";
		$agentQuery = "";

		if($disposition != "All")
		{
			$dispositionQuery = "AND disposition IN ('".$disposition."')";
		}

		if($verifiedstatus != "All")
		{
			$verifiedQuery = "AND verified_status IN ('".$verifiedstatus."')";
		}

		if($agent != "All")
		{
			$agentQuery = "AND agent_id IN ('".$agent."')";
		}

		$query = "SELECT disposition, verified_status, COUNT(phone_num) as totalcount 
					FROM qa_forms 
					WHERE created_at >= '$from' AND created_at <= '$to' $dispositionQuery $verifiedQuery $agentQuery
					GROUP BY disposition, verified_status ORDER BY 1;";

		$data = DB::connection('pgsql')->select($query);
		return json_encode($data);	
	}

	public function apiqasummary2()
	{
		$from           = Input::get("from");
		$to             = Input::get("to");
		$agent          = Input::get("agent");
		$disposition    = Input::get("disposition");
		$verifiedstatus = Input::get("verifiedstatus");
		$dispositionQuery = " AND disposition IN('Completed Survey', 'MCS Record')";
		$verifiedQuery = "";
		$agentQuery = "";

		if($disposition != "All")
		{
			$dispositionQuery = "AND disposition IN ('".$disposition."')";
		}

		if($verifiedstatus != "All")
		{
			$verifiedQuery = "AND verified_status IN ('".$verifiedstatus."')";
		}

		if($agent != "All")
		{
			$agentQuery = "AND agent_id IN ('".$agent."')";
		}

		$query = "SELECT *
					FROM qa_forms 
					WHERE created_at >= '$from' AND created_at <= '$to' $dispositionQuery $verifiedQuery $agentQuery
					ORDER BY created_at ASC;";

		$data = DB::connection('pgsql')->select($query);
		return json_encode($data);				
	}

	public function apigetqaresponses($id)
	{
		$query = "SELECT a.question_id, a.response, b.columnheader FROM qa_responses a INNER JOIN questions b ON a.question_id = b.id WHERE qa_forms_id = '$id';";
		$data = DB::connection('pgsql')->select($query);
		return json_encode($data);
	}

	public function showCampaignGross()
	{
		if(Auth::user()->isAdmin == 1 || Auth::user()->isAdmin == 2 || Auth::user()->isAdmin == 4)
		{
			return view('reports.campaigngrossperformance');
		}
		else
		{
			return Response::view('errors.404', array(), 404);
		}

		return view('reports.campaigngrossperformance');
	}

	public function apicampaigngrossperformance()
	{
		$from = Input::get("from");
		$to   = Input::get("to");

		$query = "SELECT created_at::date AS start_date,
				created_at::date + 1 AS end_date,
				COUNT(case when disposition = 'Completed Survey' then id end) AS completedsurvey, 
				COUNT(case when disposition = 'Partial Survey' then id end) AS partialsurvey, 
				(COUNT(case when disposition = 'Partial Survey' then id end) * 0.40 ) + (COUNT(case when disposition = 'Completed Survey' then id end) * 1.75) AS revenue  
				FROM forms 
				WHERE created_at >= '$from'::date AND created_at <= '$to'::date
				GROUP BY created_at::date ORDER BY start_date;";
		$data = DB::connection('pgsql')->select($query);		

		return json_encode($data);
	}

	public function showCampaignNet()
	{
		if(Auth::user()->isAdmin == 1 || Auth::user()->isAdmin == 2 || Auth::user()->isAdmin == 4)
		{
			return view('reports.campaignnetperformance');
		}
		else
		{
			return Response::view('errors.404', array(), 404);
		}
		return view('reports.campaignnetperformance');
	}

	public function apicampaignnetperformance()
	{
		$from = Input::get("from");
		$to   = Input::get("to");

		$query = "SELECT b.created_at::date AS start_date,
				b.created_at::date + 1 AS end_date,
				COUNT(case when a.disposition = 'Completed Survey' then a.id end) AS completedsurvey, 
				COUNT(case when a.disposition = 'Partial Survey' then a.id end) AS partialsurvey, 
				(COUNT(case when a.disposition = 'Partial Survey' then a.id end) * 0.40 ) + (COUNT(case when a.disposition = 'Completed Survey' then a.id end) * 1.75) AS revenue 
				FROM qa_forms a INNER JOIN forms b ON b.id = a.orig_crm_id
				WHERE b.created_at >= '$from'::date AND b.created_at <= '$to'::date AND b.isverified = 1 AND verified_status IN ('Passed-With Changes', 'Passed-Approved')
				GROUP BY b.created_at::date ORDER BY start_date;";


		$data = DB::connection('pgsql')->select($query);		

		return json_encode($data);
	}


}

