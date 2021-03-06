<?php namespace App\Http\Controllers;

use Validator;
use Input;
use Redirect;
use Session;
use View;
use \App\Http\Models\Customer;
use Excel;
use DB;
use \App\SSP;
use Datatables;

class CustomerController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
        $this->middleware('auth');
	}

    public function getUploadCsv()
    {
        return view('customer.upload');
    }

    public function postUploadCsv()
    {
        $rules = array(
            'file' => 'required|mimes:xlsx,xls',
        );

        $validator = Validator::make(Input::all(), $rules);
        // process the form
        if ($validator->fails()) 
        {
            return Redirect::to('customer-upload')->withErrors($validator);
        }
        else 
        {
            $file = Input::file('file');
            Excel::load($file, function($reader) {
                // Getting all results
                $results = $reader->get()->toArray();
                foreach ($results as $key => $value) {
                    $customer = new Customer();
                    $customer->title          =  $value['title'];
                    $customer->gender         =  $value['gender'];
                    $customer->gender         =  $value['gender'];
                    $customer->firstname      =  $value['first_name'];
                    $customer->lastname       =  $value['last_name'];
                    $customer->postcode       =  $value['postcode'];
                    $customer->addr1          =  $value['address_1'];
                    $customer->addr2          =  $value['address_2'];
                    $customer->addr3          =  $value['address_3'];
                    $customer->addr4          =  $value['address_4'];
                    $customer->town           =  $value['town'];
                    $customer->country        =  $value['country'];
                    $customer->phone_num      =  $value['phone'];
                    $customer->phone_type     =  $value['phone_type'];
                    $customer->birthdate      =  $value['birthdate'];
                    $customer->work_status    =  $value['work_status'];
                    $customer->home_status    =  $value['home_status'];
                    $customer->marital_status =  $value['marital_status'];
                    $customer->agebracket     =  $value['age_bracket'];
                    $customer->trackingurn    =  $value['trackingurn'];
                    $customer->source         =  $value['source'];
                    $customer->save();
                }

            });

            Session::flash('alert-success', 'Data Uploaded Successfully!');
            return Redirect::to('customer-upload');
            
        } 
    }

    public function apiGetCustomers()
    {
        $customers = Customer::select(['id','firstname','lastname','gender','phone_num', 'country', 'postcode']);

        return Datatables::of($customers)
            ->addColumn('action', function ($customer) {
                return '<a href="customer/'.$customer->id.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
    }
    

    public function apiGetByNumber()
    {
        $number = Input::get("number");
        return json_encode(Customer::where('phone_num', '=', $number)->first());
    }

	public function index()
	{
        $this->middleware('auth');
		return view('customer.index');
	}

	public function create()
	{
        $this->middleware('admin');
		return view('customer.create');
	}

	public function store()
	{
		$rules = array(
            'title'             => 'required',
            'firstname'         => 'required',
            'lastname'          => 'required',
            'gender'            => 'required',
            'birthdate'         => 'required',
            'age_bracket'       => 'required',
            'addr1'             => 'required',
            'addr2'             => 'required',
            'addr3'             => 'required',
            'addr4'             => 'required',
            'town'              => 'required',
            'country'           => 'required',
            'postcode'          => 'required',
            'phone_num'         => 'required|unique:customers',
            'phone_type'        => 'required',
            'work_status'       => 'required',
            'home_status'       => 'required',
            'marital_status'    => 'required',

        );
        
        $validator = Validator::make(Input::all(), $rules);
        
        // Check if all fields is filled
        if ($validator->fails()) 
        {
            return Redirect::to('customer/create')->withInput()->withErrors($validator);
        }
        else
        {
        	$customer = new Customer();
            $customer->title           = Input::get('title');
            $customer->gender          = Input::get('gender');
            $customer->firstname       = Input::get('firstname');
            $customer->lastname        = Input::get('lastname');
            $customer->postcode        = Input::get('postcode');
            $customer->addr1           = Input::get('addr1');
            $customer->addr2           = Input::get('addr2');
            $customer->addr3           = Input::get('addr3');
            $customer->addr4           = Input::get('addr4');
            $customer->addr4           = Input::get('addr4');
            $customer->town            = Input::get('town');
            $customer->country         = Input::get('country');
            $customer->phone_num       = Input::get('phone_num');
            $customer->phone_type      = Input::get('phone_type');
            $customer->birthdate       = Input::get('birthdate');
            $customer->work_status     = Input::get('work_status');
            $customer->home_status     = Input::get('home_status');
            $customer->marital_status  = Input::get('marital_status');
        	$customer->agebracket      = Input::get('age_bracket');
        	
            if($customer->save())
            {
                Session::flash('alert-success', 'Form Submitted Successfully.');
            }
            else
            {
                Session::flash('alert-danger', 'Error on submitting form.');
            }

            return Redirect::to('customer/create');
           
        }
	}

    public function edit($id)
    {
        $this->middleware('admin');
        $customer = Customer::find($id);
        return View::make('customer.edit')->with('customer', $customer);
    }

    public function update($id)
    {
        $rules = array(
            'title'             => 'required',
            'firstname'         => 'required',
            'lastname'          => 'required',
            'gender'            => 'required',
            'birthdate'         => 'required',
            'age_bracket'       => 'required',
            'addr1'             => 'required',
            'addr2'             => 'required',
            'addr3'             => 'required',
            'addr4'             => 'required',
            'town'              => 'required',
            'country'           => 'required',
            'postcode'          => 'required',
            'phone_num'         => 'required|unique:customers,phone_num,'.$id.',id',
            'phone_type'        => 'required',
            'work_status'       => 'required',
            'home_status'       => 'required',
            'marital_status'    => 'required',

        );
        
        $validator = Validator::make(Input::all(), $rules);
  
        
        // Check if all fields is filled
        if ($validator->fails()) 
        {
            return Redirect::to('customer/'.$id.'/edit')->withErrors($validator);
        }
        else
        {
            $customer = Customer::find($id);
            $customer->title           = Input::get('title');
            $customer->gender          = Input::get('gender');
            $customer->firstname       = Input::get('firstname');
            $customer->lastname        = Input::get('lastname');
            $customer->postcode        = Input::get('postcode');
            $customer->addr1           = Input::get('addr1');
            $customer->addr2           = Input::get('addr2');
            $customer->addr3           = Input::get('addr3');
            $customer->addr4           = Input::get('addr4');
            $customer->addr4           = Input::get('addr4');
            $customer->town            = Input::get('town');
            $customer->country         = Input::get('country');
            $customer->phone_num       = Input::get('phone_num');
            $customer->phone_type      = Input::get('phone_type');
            $customer->birthdate       = Input::get('birthdate');
            $customer->work_status     = Input::get('work_status');
            $customer->home_status     = Input::get('home_status');
            $customer->marital_status  = Input::get('marital_status');
            $customer->agebracket      = Input::get('age_bracket');
            
            if($customer->save())
            {
                Session::flash('alert-success', 'Customer Updated Successfully.');
            }
            else
            {
                Session::flash('alert-danger', 'Error on submitting form.');
            }

            return Redirect::to('customer/'.$id.'/edit');
           
        }
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
       
        Session::flash('alert-success', 'Successfully deleted the customer!');
        return Redirect::to('customer');
    }


}
