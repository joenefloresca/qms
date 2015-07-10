<?php namespace App\Http\Controllers;

use Validator;
use Input;
use Redirect;
use Session;
use View;
use \App\Http\Models\Customer;

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

    public function apiGetCustomers()
    {
        $customers = Customer::orderBy('id', 'desc')->get();
        return json_encode($customers);
    }

    public function apiGetByNumber()
    {
        $number = Input::get("number");
        return json_encode(Customer::where('phone_num', '=', $number)->first());
    }

	public function index()
	{
		return view('customer.index');
	}

	public function create()
	{
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
            return Redirect::to('customer/create')->withErrors($validator);
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


}
