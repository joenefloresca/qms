<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\Mutual;
use DB;
use Validator;
use Input;
use Session;
use Redirect;
use Datatables;


class MutualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mutual.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $question_options = array('' => 'Choose One') + DB::table('questions')->lists('columnheader','id');
        return view('mutual.create')->with(array('question_options' => $question_options));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'question_id_1' => 'required',
            'question_id_2' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) 
        {
            return Redirect::to('question/create')->withInput()->withErrors($validator);
        }
        else
        {
            $mutual = new Mutual();
            $mutual->question_id_1 = Input::get("question_id_1");
            $mutual->question_id_2 = Input::get("question_id_2");
            if($mutual->save())
            {
                Session::flash('alert-success', 'Form Submitted Successfully.');
            }
            else
            {
                Session::flash('alert-danger', 'Form submit failed. Please try again.');
            }

            return Redirect::to('mutual/create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mutual = Mutual::find($id);
        $question_options = array('' => 'Choose One') + DB::table('questions')->lists('columnheader','id');
        return view('mutual.edit')->with(array('question_options' => $question_options, 'mutual' => $mutual));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'question_id_1' => 'required',
            'question_id_2' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) 
        {
            return Redirect::to('question/create')->withInput()->withErrors($validator);
        }
        else
        {
            $mutual = Mutual::find($id);
            $mutual->question_id_1 = Input::get("question_id_1");
            $mutual->question_id_2 = Input::get("question_id_2");
            if($mutual->save())
            {
                Session::flash('alert-success', 'Form Submitted Successfully.');
            }
            else
            {
                Session::flash('alert-danger', 'Form submit failed. Please try again.');
            }

            return Redirect::to('mutual');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function apiGetMutualExclusives()
    {
        $mutual = DB::table('mutuals AS m')
            ->join('questions AS a', 'a.id', '=', 'm.question_id_1')
            ->join('questions AS b', 'b.id', '=', 'm.question_id_2')
            ->select('m.id', 'a.columnheader AS q1', 'b.columnheader AS q2');
         

        return Datatables::of($mutual)
            ->addColumn('action', function ($mutual) {
                return '<a href="mutual/'.$mutual->id.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
    }
}
