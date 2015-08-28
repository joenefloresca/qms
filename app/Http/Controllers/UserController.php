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

    public function getAgentCompletedSurvey()
    {
        $user_id = Input::get('agent_id');
        $today = date('Y-m-d');

        $query = "SELECT COUNT(id) as completed_survey FROM forms WHERE disposition = 'Completed Survey' AND agent_id = $user_id AND created_at = '$today'";
        $data = DB::connection('pgsql')->select($query);

        return $data[0]->completed_survey;
    }

    public function getAgentPartialSurvey()
    {
        $user_id = Input::get('agent_id');
        $today = date('Y-m-d');

        $query = "SELECT COUNT(id) as partital_survey FROM forms WHERE disposition = 'Partial Survey' AND agent_id = $user_id AND created_at = '$today'";
        $data = DB::connection('pgsql')->select($query);

        return $data[0]->partital_survey;
    }
}
