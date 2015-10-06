<?php namespace App\Http\Controllers;

use Validator;
use Input;
use Redirect;
use Session;
use View;
use \App\Http\Models\Crm;
use \App\Http\Models\Response;
use \App\Http\Models\QaCrm;
use \App\Http\Models\QaResponse;
use \App\Http\Models\Question;
use \App\Http\Models\Telesurveymaster;
use \App\User;
use Auth;
use DB;

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
        if(Auth::user()->isAdmin == 1 || Auth::user()->isAdmin == 3 )
        {
            $this->middleware('admin');
            return view('qa.verifylist');
        }
        else
        {
            return Response::view('errors.404', array(), 404);
        }
        
    }

    public function getCrmList()
    {
        $crm = new Crm();
        return json_encode($crm->getCrmList());
        /**
        /*=================================================================*/
        /*
         * Script:    DataTables server-side script for PHP and PostgreSQL
         * Copyright: 2010 - Allan Jardine
         * License:   GPL v2 or BSD (3-point)
         */
         
        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * Easy set variables
         */
         
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        // $aColumns = array(
        //     'a.id as crmid', 
        //     'b.name', 
        //     //'a.title', 
        //     //'a.firstname', 
        //     'a.surname', 
        //     'a.disposition', 
        //     'a.gross',
        //     'a.phone_num',
        //     'a.created_at'
        // );

        // /* Indexed column (used for fast and accurate table cardinality) */
        // $sIndexColumn = "a.id";

        // /* DB table to use */
        // $sTable = "forms a";
        // $sTable2 = "users b";

        // /* Database connection information */
        // $gaSql['user']       = "postgres";
        // $gaSql['password']   = "postgres";
        // $gaSql['db']         = "qms";
        // $gaSql['server']     = "localhost";

        // /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
        //  * If you just want to use the basic configuration for DataTables with PHP server-side, there is
        //  * no need to edit below this line
        //  */
         
        // /*
        //  * DB connection
        //  */
        // $gaSql['link'] = pg_connect(
        //     " host=".$gaSql['server'].
        //     " dbname=".$gaSql['db'].
        //     " user=".$gaSql['user'].
        //     " password=".$gaSql['password']
        // ) or die('Could not connect: ' . pg_last_error());

        // /*
        //  * Paging
        //  */
        // $sLimit = "";
        // if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
        // {
        //     $sLimit = "LIMIT ".intval( $_GET['iDisplayLength'] )." OFFSET ".
        //         intval( $_GET['iDisplayStart'] );
        // }
        // /*
        //  * Ordering
        //  */
        // if ( isset( $_GET['iSortCol_0'] ) )
        // {
        //     $sOrder = "ORDER BY  ";
        //     for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
        //     {
        //         if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
        //         {
        //             $sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
        //                 ".($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc').", ";
        //         }
        //     }
             
        //     $sOrder = substr_replace( $sOrder, "", -2 );
        //     if ( $sOrder == "ORDER BY" )
        //     {
        //         $sOrder = "";
        //     }
        // }

        // /*
        //  * Filtering
        //  * NOTE This assumes that the field that is being searched on is a string typed field (ie. one
        //  * on which ILIKE can be used). Boolean fields etc will need a modification here.
        //  */
        // $sWhere = "";
        // if ( $_GET['sSearch'] != "" )
        // {
        //     $sWhere = "WHERE (";
        //     for ( $i=0 ; $i<count($aColumns) ; $i++ )
        //     {
        //         if ( $_GET['bSearchable_'.$i] == "true" )
        //         {
        //             if($aColumns[$i] != 'id') // Exclude ID for filtering
        //             {
        //                 $sWhere .= $aColumns[$i]." ILIKE '%".pg_escape_string( $_GET['sSearch'] )."%' OR ";
        //             }
        //         }
        //     }
        //     $sWhere = substr_replace( $sWhere, "", -3 );
        //     $sWhere .= ")";
        // }


        //  /* Individual column filtering */
        // for ( $i=0 ; $i<count($aColumns) ; $i++ )
        // {
        //     var_dump($_GET['bSearchable_8']);

        //     if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
        //     {
        //         if ( $sWhere == "" )
        //         {
        //             $sWhere = "WHERE ";
        //         }
        //         else
        //         {
        //             $sWhere .= " AND ";
        //         }
        //         $sWhere .= $aColumns[$i]." ILIKE '%".pg_escape_string($_GET['sSearch_'.$i])."%' ";
        //     }
        // }

        // $sQuery = "
        //     SELECT ".str_replace(" , ", " ", implode(", ", $aColumns))."
        //     FROM $sTable INNER JOIN $sTable2 ON a.agent_id = b.id
        //     $sWhere
        //     $sOrder
        //     $sLimit
        // ";

        // $rResult = pg_query( $gaSql['link'], $sQuery ) or die(pg_last_error());

        // $sQuery = "
        //     SELECT $sIndexColumn
        //     FROM   $sTable INNER JOIN $sTable2 ON a.agent_id = b.id
        // ";
        // $rResultTotal = pg_query( $gaSql['link'], $sQuery ) or die(pg_last_error());
        // $iTotal = pg_num_rows($rResultTotal);
        // pg_free_result( $rResultTotal );
         
        // if ( $sWhere != "" )
        // {
        //     $sQuery = "
        //         SELECT $sIndexColumn
        //         FROM   $sTable INNER JOIN $sTable2 ON a.agent_id = b.id
        //         $sWhere
        //     ";
        //     $rResultFilterTotal = pg_query( $gaSql['link'], $sQuery ) or die(pg_last_error());
        //     $iFilteredTotal = pg_num_rows($rResultFilterTotal);
        //     pg_free_result( $rResultFilterTotal );
        // }
        // else
        // {
        //     $iFilteredTotal = $iTotal;
        // }
         
        // /*
        //  * Output
        //  */
        // $output = array(
        //     "sEcho" => intval($_GET['sEcho']),
        //     "iTotalRecords" => $iTotal,
        //     "iTotalDisplayRecords" => $iFilteredTotal,
        //     "aaData" => array()
        // );
         
        // while ( $aRow = pg_fetch_array($rResult, null, PGSQL_ASSOC) )
        // {
        //     $row = array();
        //     for ( $i=0 ; $i<count($aColumns) ; $i++ )
        //     {
        //         if ( $aColumns[$i] == "version" )
        //         {
        //             /* Special output formatting for 'version' column */
        //             $row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
        //         }
        //         else if ( $aColumns[$i] != ' ' )
        //         {
        //             /* General output */
        //             $row[] = $aRow[ $aColumns[$i] ];
        //         }
        //     }
        //     $output['aaData'][] = $row;
        // }
         
        // echo json_encode( $output );
         
        // // Free resultset
        // pg_free_result( $rResult );
         
        // // Closing connection
        // pg_close( $gaSql['link'] );

        // $crm = new Crm();
        // return json_encode($crm->getCrmList());
    }

    public function showVerifyForm($crmid)
    {
        if(Auth::user()->isAdmin == 1 || Auth::user()->isAdmin == 3)
        {
            $crm = Crm::find($crmid);
            $agent_name = User::find($crm->agent_id);
            $responses = new Response();
            return View::make('qa.verifyform')->with(array('crm' => $crm, 'responses' => $responses->getResponsesByCrmId($crmid), 'agent_name' => $agent_name->name));
        }
        else
        {
            return Response::view('errors.404', array(), 404);
        }
        
    }

    public function postVerify($id)
    {
        $rules = array(
            'disposition'    => 'required',
            'gender'         => 'required',
            'title'          => 'required',
            'firstname'      => 'required',
            'lastname'       => 'required',
            'addr1'          => 'required',
            // 'addr2'          => 'required',
            // 'addr3'          => 'required',
            // 'addr4'          => 'required',
            'town'           => 'required',
            'country'        => 'required',
            'postcode'       => 'required',
            'phone_num'      => 'required',
            'phonetype'      => 'required',
            'age_bracket'    => 'required',
            'work_status'    => 'required',
            'home_status'    => 'required',
            'marital_status' => 'required',
            'orig_crm_id'    => 'required|unique:qa_forms',
        );
        
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) 
        {
            return Redirect::to('qa/verify/'.$id)->withErrors($validator);
        }
        else
        {
            $gross                  = Input::get("gross");
            $rev                    = Input::get("new_gross");
            $disposition            = Input::get("disposition");
            $gender                 = Input::get("gender");
            $title                  = Input::get("title");
            $firstname              = Input::get("firstname");
            $lastname               = Input::get("lastname");
            $addr1                  = Input::get("addr1");
            $addr2                  = Input::get("addr2");
            $addr3                  = Input::get("addr3");
            $addr4                  = Input::get("addr4");
            $town                   = Input::get("town");
            $country                = Input::get("country");
            $postcode               = Input::get("postcode");
            $phone_num              = Input::get("phone_num");
            $phonetype              = Input::get("phonetype");
            $age_bracket            = Input::get("age_bracket");
            $work_status            = Input::get("work_status");
            $home_status            = Input::get("home_status");
            $marital_status         = Input::get("marital_status");
            $isukresident           = Input::get("ispermanentresident");
            $agent_id               = Input::get("agent_id");
            $customer_id            = Input::get("customer_id");
            $comments               = Input::get("comments");
            $verified_status        = Input::get("verified_status");
            $passwithchanges_status = Input::get("passwithchanges_status");
            $reject_a_status        = Input::get("reject_a_status");
            $reject_b_status        = Input::get("reject_b_status");
            $reject_c_status        = Input::get("reject_c_status");
            $tracking_urn           = md5($phone_num.date("Y-m-d H:i:s"));

            $qacrm = new QaCrm();
            $qacrm->disposition = $disposition;
            $qacrm->gross = $gross;
            $qacrm->revenue = $rev;
            $qacrm->ispermanentresident = $agent_id;
            $qacrm->postcode = $postcode;
            $qacrm->addr1 = $addr1;
            $qacrm->addr2 = $addr2;
            $qacrm->addr3 = $addr3;
            $qacrm->addr4 = $addr4;
            $qacrm->town = $town;
            $qacrm->country = $country;
            $qacrm->title = $title;
            $qacrm->gender = $gender;
            $qacrm->firstname = $firstname;
            $qacrm->surname = $lastname;
            $qacrm->phonetype = $phonetype;
            $qacrm->phone_num = $phone_num;
            $qacrm->age_bracket = $age_bracket;
            $qacrm->work_status = $work_status;
            $qacrm->home_status = $home_status;
            $qacrm->marital_status = $marital_status;
            $qacrm->ispermanentresident = $isukresident;
            $qacrm->agent_id = $agent_id;
            $qacrm->customer_id = $customer_id;
            $qacrm->orig_crm_id = $id;
            $qacrm->comments = $comments;
            $qacrm->verified_status = $verified_status;
            $qacrm->passwithchanges_status = $passwithchanges_status;
            $qacrm->reject_a_status = $reject_a_status;
            $qacrm->reject_b_status = $reject_b_status;
            $qacrm->reject_c_status = $reject_c_status;
            $qacrm->verified_by = Auth::user()->name;
            $qacrm->verifier_id = Auth::user()->id;
            $qacrm->trackingurn = $tracking_urn;

            if($qacrm->save())
            {
                $lastInsertId = intval($qacrm->id);
                $trackingurn = QaCrm::find($lastInsertId);

                /* For 248 Insertion */
                $telesurveymaster = new Telesurveymaster();
                $telesurveymaster->TrackingURN = $tracking_urn;
                $telesurveymaster->Title = $title;
                $telesurveymaster->Firstname = $firstname;
                $telesurveymaster->Surname = $lastname;
                $telesurveymaster->Address1 = $addr1;
                $telesurveymaster->Address2 = $addr2;
                $telesurveymaster->Address3 = $addr3;
                $telesurveymaster->Address4 = $addr4;
                $telesurveymaster->Town = $town;
                $telesurveymaster->County = $country;
                $telesurveymaster->Postcode = $postcode;
                $telesurveymaster->Telephone = $phone_num;
                $telesurveymaster->MobilePhone = $phone_num;
                $telesurveymaster->Survey = 'Satellite CRM - GCL';
                $telesurveymaster->Updatedon = date("Y-m-d H:i:s");
                $telesurveymaster->AgentID = $agent_id;
                $telesurveymaster->Verifier = Auth::user()->name;
                $telesurveymaster->Revenue = $rev;
                $telesurveymaster->Gross_Revenue = $gross;
                $telesurveymaster->AgeBracket = $age_bracket;
                $telesurveymaster->CivilStatus = $marital_status;
                $telesurveymaster->Gender = $gender;
                $telesurveymaster->LivingStatus = $home_status;
                $telesurveymaster->WorkStatus = $work_status;
                $telesurveymaster->Status = $verified_status;
                $telesurveymaster->save();
                /* END For 248 Insertion */

                $questions = new QaResponse();
              
                foreach ($questions->getResponsesByCrm(intval($id)) as $key => $value) 
                {
                    $columnheader = $value->columnheader; 
                    $id_question = Question::where('columnheader', '=', $columnheader)->get();

                    $qa_response = new QaResponse();
                    $qa_response->qa_forms_id = $lastInsertId;
                    $qa_response->question_id = intval($id_question[0]->id);
                    $qa_response->response = Input::get($columnheader);
                    $qa_response->trackingurn = $trackingurn->trackingurn;
                    $qa_response->save();

                    /* For 248 Insertion */
                    //Get question columnheader based on id
                    $colheader = Question::find(intval($id_question[0]->id));
                    $affectedRows = Telesurveymaster::where('TrackingURN', '=', $tracking_urn)->update([$colheader->columnheader => Input::get($columnheader)]);
                    /* END For 248 Insertion */

                }

                Session::flash('alert-info', 'Form and responses has been saved.');
            }
            else
            {
                Session::flash('alert-danger', 'Error in saving client information and responses.');
            }

            return Redirect::to('qa/verify/'.$id);

        }
    }

    public function updateVerifiedForms()
    {
        if(Auth::user()->isAdmin == 1 || Auth::user()->isAdmin == 3)
        {
            return view('qa.updateverfied');
        }
        else
        {
            return Response::view('errors.404', array(), 404);
        }
    }

    public function getCrmReverify()
    {
        $verifiedCrm = new QaCrm();
        return json_encode($verifiedCrm->getVerifiedAll());
    }

    public function showReVerifyForm($crmid)
    {
        if(Auth::user()->isAdmin == 1 || Auth::user()->isAdmin == 3)
        {
            $crm = QaCrm::find($crmid);
            $agent_name = User::find($crm->agent_id);
            $responses = new QaResponse();
            return View::make('qa.reverifyform')->with(array('crm' => $crm, 'responses' => $responses->getQaResponsesByCrmId($crmid), 'agent_name' => $agent_name->name));
        }
        else
        {
            return Response::view('errors.404', array(), 404);
        }
        
    }

    public function postReVerify($id)
    {
        $rules = array(
            'disposition'    => 'required',
            'gender'         => 'required',
            'title'          => 'required',
            'firstname'      => 'required',
            'lastname'       => 'required',
            'addr1'          => 'required',
            // 'addr2'          => 'required',
            // 'addr3'          => 'required',
            // 'addr4'          => 'required',
            'town'           => 'required',
            'country'        => 'required',
            'postcode'       => 'required',
            'phone_num'      => 'required',
            'phonetype'      => 'required',
            'age_bracket'    => 'required',
            'work_status'    => 'required',
            'home_status'    => 'required',
            'marital_status' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) 
        {
            return Redirect::to('qa/reverify/'.$id)->withErrors($validator);
        }
        else
        {
            $gross                  = Input::get("gross");
            $rev                    = Input::get("new_gross");
            $disposition            = Input::get("disposition");
            $gender                 = Input::get("gender");
            $title                  = Input::get("title");
            $firstname              = Input::get("firstname");
            $lastname               = Input::get("lastname");
            $addr1                  = Input::get("addr1");
            $addr2                  = Input::get("addr2");
            $addr3                  = Input::get("addr3");
            $addr4                  = Input::get("addr4");
            $town                   = Input::get("town");
            $country                = Input::get("country");
            $postcode               = Input::get("postcode");
            $phone_num              = Input::get("phone_num");
            $phonetype              = Input::get("phonetype");
            $age_bracket            = Input::get("age_bracket");
            $work_status            = Input::get("work_status");
            $home_status            = Input::get("home_status");
            $marital_status         = Input::get("marital_status");
            $isukresident           = Input::get("ispermanentresident");
            $agent_id               = Input::get("agent_id");
            $customer_id            = Input::get("customer_id");
            $comments               = Input::get("comments");
            $verified_status        = Input::get("verified_status");
            $passwithchanges_status = Input::get("passwithchanges_status");
            $reject_a_status        = Input::get("reject_a_status");
            $reject_b_status        = Input::get("reject_b_status");
            $reject_c_status        = Input::get("reject_c_status");

            $crm = QaCrm::find($id);
            $crm->disposition = $disposition;
            $crm->gross = $gross;
            $crm->revenue = $rev;
            $crm->ispermanentresident = $agent_id;
            $crm->postcode = $postcode;
            $crm->addr1 = $addr1;
            $crm->addr2 = $addr2;
            $crm->addr3 = $addr3;
            $crm->addr4 = $addr4;
            $crm->town = $town;
            $crm->country = $country;
            $crm->title = $title;
            $crm->gender = $gender;
            $crm->firstname = $firstname;
            $crm->surname = $lastname;
            $crm->phonetype = $phonetype;
            $crm->phone_num = $phone_num;
            $crm->age_bracket = $age_bracket;
            $crm->work_status = $work_status;
            $crm->home_status = $home_status;
            $crm->marital_status = $marital_status;
            $crm->ispermanentresident = $isukresident;
            $crm->agent_id = $agent_id;
            $crm->customer_id = $customer_id;
            $crm->orig_crm_id = $id;
            $crm->comments = $comments;
            $crm->verified_status = $verified_status;
            $crm->passwithchanges_status = $passwithchanges_status;
            $crm->reject_a_status = $reject_a_status;
            $crm->reject_b_status = $reject_b_status;
            $crm->reject_c_status = $reject_c_status;
            $crm->verified_by = Auth::user()->name;
            $crm->verifier_id = Auth::user()->id;
            $trackingurn = $crm->trackingurn;

            if($crm->save())
            {
                /* For 248 update */
                $affectedRows = Telesurveymaster::where('TrackingURN', '=', $crm->trackingurn)->update([
                    'Title' => $title,
                    'Firstname' => $firstname,
                    'Surname' => $lastname,
                    'Address1' => $addr1,
                    'Address2' => $addr2,
                    'Address3' => $addr3,
                    'Address4' => $addr4,
                    'Town' => $town,
                    'County' => $country,
                    'Postcode' => $postcode,
                    'Telephone' => $phone_num,
                    'MobilePhone' => $phone_num,
                    'AgeBracket' => $age_bracket,
                    'CivilStatus' => $marital_status,
                    'Gender' => $gender,
                    'LivingStatus' => $home_status,
                    'WorkStatus' => $work_status,
                    'Revenue' => $rev,
                    'Gross_Revenue' => $gross,
                    'Status' => $verified_status,
                ]);
                /* END For 248 update */

                $questions = new QaResponse();
              
                foreach ($questions->getQaResponsesByCrmId(intval($id)) as $key => $value) 
                {
                    $columnheader = $value->columnheader; 
                    $id_question = Question::where('columnheader', '=', $columnheader)->get();
                    $qa_response = QaResponse::find($value->id);
                    $qa_response->response = Input::get($columnheader);
                    $qa_response->save();

                    /* For 248 update */
                    //Get question columnheader based on id
                    $colheader = Question::find(intval($id_question[0]->id));
                    $affectedRows = Telesurveymaster::where('TrackingURN', '=', $trackingurn)->update([$colheader->columnheader => Input::get($columnheader)]);
                    /* END For 248 update */
                }

                Session::flash('alert-info', 'Form and responses has been updated.');
            }
            else
            {
                Session::flash('alert-danger', 'Error in saving client information and responses.');
            }

            return Redirect::to('qa/reverify/'.$id)->withErrors($validator);

        }

    }

    public function getQuestionCplResponse()
    {
        $columnheader = Input::get("colheader");
        $data = DB::table('questions')->where('columnheader', $columnheader)->value('costperlead');
        return $data;
    }

}
