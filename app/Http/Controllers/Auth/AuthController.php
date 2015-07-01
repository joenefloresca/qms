<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Auth;
use Illuminate\Http\Request;
use App\Http\Models\LoginHour;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;


    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        date_default_timezone_set('Asia/Taipei');

        $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);

        $credentials = $this->getCredentials($request);

        if (Auth::attempt($credentials, $request->has('remember'))) {

            
            $userid = Auth::user()->id;
            $today = date('Y-m-d');
            $timestamp = date('Y-m-d h:i:s');
            $checkLogin = LoginHour::where('date', '=', $today)->
                                     where('user_id', '=', $userid)->first();
            if($checkLogin == null)
            {
                $insertLoginHours = new LoginHour();
                $insertLoginHours->user_id = $userid;
                $insertLoginHours->date = $today;
                $insertLoginHours->status = 1;
                $insertLoginHours->timestamp = $timestamp;
                $insertLoginHours->save();
            }
            else
            {
                LoginHour::where('date', '=', $today)->
                        where('user_id', '=', $userid)->
                        update(['timestamp' => $timestamp, 'status' => 1]);
            }
                 
            return redirect()->intended($this->redirectPath());
        }

        return redirect($this->loginPath())
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => $this->getFailedLoginMessage(),
            ]);
    }



    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {

        date_default_timezone_set('Asia/Taipei');

        $userid = Auth::user()->id;
        $today = date('Y-m-d');
        $checkLogin = LoginHour::where('date', '=', $today)->
                                 where('user_id', '=', $userid)->
                                 where('status', '=', 1)->
                                 first();
        if($checkLogin != null)
        {
            $loginhours = '';
            $timestamp = date('Y-m-d h:i:s');
            $timestamp2 = strtotime($timestamp);

            $userLastLogin = $checkLogin->timestamp;
            $userLastLogin2 = strtotime($userLastLogin);
           
            // Get difference in hours
            $diffHours = round(($timestamp2 - $userLastLogin2) / 3600, 2);


            LoginHour::where('date', '=', $today)->
                        where('user_id', '=', $userid)->
                        update(['loginhours' => $checkLogin->loginhours + $diffHours, 'status' => 0, 'timestamp' => $timestamp]);
        }                         

                               

        Auth::logout();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/auth/login');
    }
}
