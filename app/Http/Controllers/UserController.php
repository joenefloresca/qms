<?php

namespace App\Http\Controllers;
use App\Http\Models\LoginHour;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use DB;

class UserController extends Controller
{
    public function getAgentLoginHours()
    {
        $user_id = Input::get('agent_id');
        $loginHour = LoginHour::where('created_at', '=', date('Y-m-d'))->where('user_id', '=', $user_id)->first();
        return $loginHour['loginhours'];
    }

    public function getAgentDayGross()
    {
        $user_id = Input::get('agent_id');
        $query = "SELECT SUM(gross) FROM forms WHERE agent_id = ".$user_id." AND created_at = '".date('Y-m-d')."';";
        $data = DB::connection('pgsql')->select($query);

        return $data[0]->sum;
    }
}
