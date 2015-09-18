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
        $loginHour = LoginHour::where('date', '=', date('Y-m-d'))->where('user_id', '=', $user_id)->first();
        return $loginHour['loginhours'];
    }

    public function getAgentDayGross()
    {
        $user_id = Input::get('agent_id');
        $query = "SELECT SUM(gross) FROM forms WHERE agent_id = ".$user_id." AND created_at = '".date('Y-m-d')."';";
        $data = DB::connection('pgsql')->select($query);

        return $data[0]->sum;
    }

    public function getAgentCompletedSurvey()
    {
        $user_id = Input::get('agent_id');
        $today = date('Y-m-d');

        $query = "SELECT COUNT(id) as completed_survey FROM forms WHERE disposition = 'Completed Survey' AND agent_id = $user_id AND created_at::date = '$today'";
        $data = DB::connection('pgsql')->select($query);

        return $data[0]->completed_survey;
    }

    public function getAgentPartialSurvey()
    {
        $user_id = Input::get('agent_id');
        $today = date('Y-m-d');

        $query = "SELECT COUNT(id) as partital_survey FROM forms WHERE disposition = 'Partial Survey' AND agent_id = $user_id AND created_at::date = '$today'";
        $data = DB::connection('pgsql')->select($query);

        return $data[0]->partital_survey;
    }

    public function getAgentLoginHoursLive()
    {
        date_default_timezone_set('Europe/London');
        $userid = Input::get('agent_id');

        $today = date('Y-m-d');
        $logHour = new LoginHour();
        $checkLogin = $logHour->checkLoginHoursOutLive(intval($userid), $today);

        if($checkLogin != null)
        {
            $loginhours = '';
            $timestamp = date('Y-m-d H:i:s', time());
            $timestamp2 = strtotime($timestamp);

            $userLastLogin = $checkLogin[0]->created_at;
            $userLastLogin2 = strtotime($userLastLogin);
           
            // Get difference in hours
            $diffHours = round(($timestamp2 - $userLastLogin2) / 3600, 2);

            LoginHour::where('date', '=', $today)->
                        where('user_id', '=', $userid)->
                        update(['loginhours' => $diffHours, 'status' => 0, 'timestamp' => $timestamp, 'lastlogout' => $timestamp]);
        }

        return null ;
    }
}
