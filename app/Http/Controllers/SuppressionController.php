<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use \App\Http\Models\Suppression;
use Validator;
use Session;
use Redirect;
use Datatables;
use Excel;
use Symfony\Component\Console\Helper\ProgressBar;
use DB;

class SuppressionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('suppression.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('suppression.create');
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
            'phone'          => 'required',
            'column_header'  => 'required',       
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) 
        {
            return Redirect::to('suppression/create')->withInput()->withErrors($validator);
        }
        else
        {
            $suppression = new Suppression();
            $suppression->phone         = Input::get("phone");
            $suppression->column_header = Input::get("column_header");
            if($suppression->save())
            {
                Session::flash('alert-success', 'Form Submitted Successfully.');
            }
            else
            {
                Session::flash('alert-danger', 'Form Submission Failed. Please try again.');
            }

            return Redirect::to('suppression/create');

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
        //
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
        //
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

    public function apiGetSuppressions()
    {
        $suppressions = Suppression::select(['id','phone','column_header','created_at']);

        return Datatables::of($suppressions)
            ->addColumn('action', function ($suppression) {
                return '<a href="suppression/'.$suppression->id.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
    }

    public function getSuppUploadCsv()
    {
        $question_options = array('' => 'Choose One') + DB::table('questions')->lists('columnheader','columnheader');
        return view('suppression.suppression-upload')->with(array('question_options' => $question_options));
    }

    public function postSuppUploadCsv()
    {
        $rules = array(
            'file'             => 'required|mimes:xlsx,xls',
            'question_options' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);
        // process the form
        if ($validator->fails()) 
        {
            return Redirect::to('suppression-upload')->withErrors($validator);
        }
        else
        { 
            $file          = Input::file('file');
            $column_header = Input::get('question_options');
            Excel::load($file, function($reader) use ($column_header) {
                // Getting all results
                $results = $reader->get()->toArray();
                foreach ($results as $key => $value) {
                     $suppression = new Suppression();
                     $suppression->phone         = $value['phone'];
                     $suppression->column_header = $column_header;
                     $suppression->save();
                 }

            });

            Session::flash('alert-success', 'Data Uploaded Successfully!');
            return Redirect::to('suppression-upload');
        }
    }
}
