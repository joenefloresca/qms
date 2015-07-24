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
use \App\User;
use Auth;

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
        $agent_name = User::find($crm->agent_id);
        $responses = new Response();
        return View::make('qa.verifyform')->with(array('crm' => $crm, 'responses' => $responses->getResponsesByCrmId($crmid), 'agent_name' => $agent_name->name));
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
            'addr2'          => 'required',
            'addr3'          => 'required',
            'addr4'          => 'required',
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
            $passwithchanges_status = Input::get("passwithchanges_status");
            $reject_a_status        = Input::get("reject_a_status");
            $reject_b_status        = Input::get("reject_b_status");
            $reject_c_status        = Input::get("reject_c_status");

            $qacrm = new QaCrm();
            $qacrm->disposition = $disposition;
            $qacrm->gross = $gross;
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
            $qacrm->passwithchanges_status = $passwithchanges_status;
            $qacrm->reject_a_status = $reject_a_status;
            $qacrm->reject_b_status = $reject_b_status;
            $qacrm->reject_c_status = $reject_c_status;
            $qacrm->verified_by = Auth::user()->name;

            if($qacrm->save())
            {
                $lastInsertId = intval($qacrm->id);
                $questions = new QaResponse();
              
                foreach ($questions->getResponsesByCrm(intval($id)) as $key => $value) 
                {
                    $columnheader = $value->columnheader; 
                    $id_question = Question::where('columnheader', '=', $columnheader)->get();

                    $qa_response =new QaResponse();
                    $qa_response->qa_forms_id = $lastInsertId;
                    $qa_response->question_id = intval($id_question[0]->id);
                    $qa_response->response = Input::get($columnheader);
                    $qa_response->save();
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
        $this->middleware('admin');
        return view('qa.updateverfied');
    }

    public function getCrmReverify()
    {
        $verifiedCrm = new QaCrm();
        return json_encode($verifiedCrm->getVerifiedAll());
    }

    public function showReVerifyForm($crmid)
    {
        $this->middleware('admin');
        $crm = QaCrm::find($crmid);
        $agent_name = User::find($crm->agent_id);
        $responses = new QaResponse();
        return View::make('qa.reverifyform')->with(array('crm' => $crm, 'responses' => $responses->getQaResponsesByCrmId($crmid), 'agent_name' => $agent_name->name));
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
            'addr2'          => 'required',
            'addr3'          => 'required',
            'addr4'          => 'required',
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
            $passwithchanges_status = Input::get("passwithchanges_status");
            $reject_a_status        = Input::get("reject_a_status");
            $reject_b_status        = Input::get("reject_b_status");
            $reject_c_status        = Input::get("reject_c_status");

            $crm = QaCrm::find($id);
            $crm->disposition = $disposition;
            $crm->gross = $gross;
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
            $crm->passwithchanges_status = $passwithchanges_status;
            $crm->reject_a_status = $reject_a_status;
            $crm->reject_b_status = $reject_b_status;
            $crm->reject_c_status = $reject_c_status;
            $crm->verified_by = Auth::user()->name;
            if($crm->save())
            {
                $questions = new QaResponse();
              
                foreach ($questions->getQaResponsesByCrmId(intval($id)) as $key => $value) 
                {


                    var_dump($value->id);
                    // $columnheader = $value->columnheader; 
                    // $id_question = Question::where('columnheader', '=', $columnheader)->get();

                    // $qa_response =new QaResponse();
                    // $qa_response->question_id = intval($id_question[0]->id);
                    // $qa_response->response = Input::get($columnheader);
                    // $qa_response->save();
                }

                exit();

                Session::flash('alert-info', 'Form and responses has been updated.');
            }
            else
            {
                Session::flash('alert-danger', 'Error in saving client information and responses.');
            }

            return Redirect::to('qa/reverify/'.$id)->withErrors($validator);

        }


    }

}
