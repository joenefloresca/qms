<?php namespace App\Http\Controllers;

use Validator;
use Input;
use Redirect;
use Session;
use View;
use \App\Http\Models\Question;
use App;

class QuestionController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function apiGetQuestions()
	{
		$questions = Question::orderBy('sortorder', 'asc')->get();
		return json_encode($questions);
	}

    public function apiSortQuestions()
    { 
        $affectedRows = Question::where('sortorder', '=', Input::get('value'))
        ->where('id', '=', Input::get('id'))
        ->update(['sortorder' => Input::get('cnt')]);

        return $affectedRows;
    }

    public function apiQuestionChangeEnable()
    {
        $affectedRows = Question::where('columnheader', '=', Input::get('id'))
                                ->update(['isenabled' => Input::get('isenabled')]);

        return $affectedRows;
    }

	public function index()
	{
		return view('question.index');
	}

	public function create()
	{
		return view('question.create');
	}

	public function store()
	{
        // $verifier = App::make('validation.presence');
        // $verifier->setConnection('mcssurvey_main');

		$rules = array(
            'Question'  			=> 'required',
            'CostPerLead'    		=> 'required',
            'ColumnHeader'    		=> 'required',
            'DeliveryAssignment'    => 'required',
            //'sortorder'             => 'required|unique:questions',
        );
        
        $validator = Validator::make(Input::all(), $rules);
        // $validator->setPresenceVerifier($verifier);
        
        // Check if all fields is filled
        if ($validator->fails()) 
        {
            return Redirect::to('question/create')->withErrors($validator);
        }
        else
        {
            if(Input::get("numGenerate") == "") // For Single Questions
            {
                $question = new Question();
                $question->question             = Input::get('Question');
                $question->postcoderestriction  = Input::get('PostCodeRestriction');
                $question->postcodeinclusion    = Input::get('PostCodeInclusion');
                $question->postcodeexclusion    = Input::get('PostCodeExclusion');
                $question->agerestriction       = Input::get('AgeRestriction');
                $question->agebracket           = Input::get('AgeBracket');
                $question->ownhomerestriction   = Input::get('OwnHomeRestriction');
                $question->ownhomeoptions       = Input::get('OwnHomeOptions');
                $question->telephonerestriction = Input::get('TelephoneRestriction');
                $question->telephoneoptions     = Input::get('TelephoneOptions');
                $question->costperlead          = Input::get('CostPerLead');
                $question->columnheader         = Input::get('ColumnHeader');
                $question->deliveryassignment   = Input::get('DeliveryAssignment');
                $question->isenabled            = Input::get('IsEnabled');
                $question->po_num               = Input::get('po_num');
                $question->save();

                $question = Question::find($question->id);
                $question->sortorder = $question->id;
                $question->save();

                Session::flash('alert-success', 'Form Submitted Successfully.');

                return Redirect::to('question/create');
            }
            else // For multi-part Questions
            {
                $numChild = intval(Input::get("numGenerate"));

                // Save the main question first
                $question = new Question();
                $question->question              = Input::get('Question');
                $question->postcoderestriction   = Input::get('PostCodeRestriction');
                $question->postcodeinclusion     = Input::get('PostCodeInclusion');
                $question->postcodeexclusion     = Input::get('PostCodeExclusion');
                $question->agerestriction        = Input::get('AgeRestriction');
                $question->agebracket            = Input::get('AgeBracket');
                $question->ownhomerestriction    = Input::get('OwnHomeRestriction');
                $question->ownhomeoptions        = Input::get('OwnHomeOptions');
                $question->telephonerestriction  = Input::get('TelephoneRestriction');
                $question->telephoneoptions      = Input::get('TelephoneOptions');
                $question->costperlead           = Input::get('CostPerLead');
                $question->columnheader          = Input::get('ColumnHeader');
                $question->deliveryassignment    = Input::get('DeliveryAssignment');
                $question->isenabled             = Input::get('IsEnabled');
                $question->po_num                = Input::get('po_num');
                $question->child_count           = $numChild;
                $question->save();

                $question = Question::find($question->id);
                $question->sortorder = $question->id;
                $question->save();

                // Then the child questions
                for($x = 1; $x <= $numChild; $x++)
                {
                    $colheader = Input::get('ColumnHeader')."_".$x;
                    $questionChild = new Question();
                    $questionChild->question              = Input::get($colheader);
                    $questionChild->costperlead           = floatval(Input::get($colheader."_cost"));
                    $questionChild->child_enable_response = Input::get($colheader."_response");
                    $questionChild->isenabled             = Input::get('IsEnabled');
                    $questionChild->is_child              = 1;
                    $questionChild->columnheader          = $colheader;
                    $questionChild->po_num                = Input::get('po_num');
                    $questionChild->deliveryassignment    = Input::get('DeliveryAssignment');
                    $questionChild->parent_colheader      = Input::get('ColumnHeader');
                    $questionChild->save();

                    $question_sort = Question::find($questionChild->id);
                    $question_sort->sortorder = $questionChild->id;
                    $question_sort->save();
                }

                Session::flash('alert-success', 'Multi Question Form Submitted Successfully.');

                return Redirect::to('question/create');

            }
        	
        }
	}

	public function edit($id)
	{
		$question = Question::find($id);
		return View::make('question.edit')->with('question', $question);
	}

	public function update($id)
	{
        $verifier = App::make('validation.presence');
        $verifier->setConnection('mcssurvey_main');

		$rules = array(
            'Question'  			=> 'required',
            'CostPerLead'    		=> 'required',
            'ColumnHeader'    		=> 'required',
            'DeliveryAssignment'    => 'required',
            'IsEnabled'             => 'required',
            //'sortorder'             => 'required|unique:questions',
        );
        
        $validator = Validator::make(Input::all(), $rules);
        $validator->setPresenceVerifier($verifier);
        
        // Check if all fields is filled
        if ($validator->fails()) 
        {
            return Redirect::to('question')->withErrors($validator);
        }
        else
        {
        	$question = Question::find($id);
        	$question->question = Input::get('Question');
            $question->postcoderestriction = Input::get('PostCodeRestriction');
            $question->postcodeinclusion = Input::get('PostCodeInclusion');
            $question->postcodeexclusion = Input::get('PostCodeExclusion');
            $question->agerestriction = Input::get('AgeRestriction');
            $question->agebracket = Input::get('AgeBracket');
            $question->ownhomerestriction = Input::get('OwnHomeRestriction');
            $question->ownhomeoptions = Input::get('OwnHomeOptions');
            $question->telephonerestriction = Input::get('TelephoneRestriction');
            $question->telephoneoptions = Input::get('TelephoneOptions');
            $question->costperlead = Input::get('CostPerLead');
            $question->columnheader = Input::get('ColumnHeader');
            $question->deliveryassignment = Input::get('DeliveryAssignment');
            $question->isenabled = Input::get('IsEnabled');
            //$question->sortorder = Input::get('sortorder');
        	$question->save();

        	Session::flash('alert-success', 'Question Updated Successfully.');

            return Redirect::to('question');
        }
	}

	
	public function destroy($id)
    {
        $question = Question::find($id);
        $question->delete();
       
        Session::flash('alert-success', 'Successfully deleted the question!');
        return Redirect::to('question');
    }

}
