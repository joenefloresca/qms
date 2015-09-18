<?php

namespace App\Http\Models;
use DB;

class LoginHour extends \Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */

    /* Default for Eloquent */
    protected $table = 'loginhours';
    protected $connection = 'pgsql';

    public function getLoginHours()
    {
    	$query = "SELECT a.name, b.date, b.status, b.loginhours from users a INNER JOIN loginhours b ON a.id = b.user_id;";
    	$data = DB::connection('pgsql')->select($query);
		          
		return $data;
    }

    public function checkLoginHours($user_id, $today)
    {
        $query = "SELECT * FROM loginhours 
                WHERE user_id = '$user_id' AND date = '$today' 
                AND status = 0 
                AND TIMESTAMP < CAST((CAST(now() AS DATE) + INTEGER '1') as TIMESTAMP) + INTERVAL '6 hours'";
        $data = DB::connection('pgsql')->select($query);
                  
        return $data;        
    }

    public function checkLoginHoursOut($user_id, $today)
    {
        $query = "SELECT * FROM loginhours 
                WHERE user_id = '$user_id' AND date = '$today' 
                AND status = 1 ";
                // AND TIMESTAMP < CAST((CAST(now() AS DATE) + INTEGER '1') as TIMESTAMP) + INTERVAL '6 hours'
                // ";
        $data = DB::connection('pgsql')->select($query);
                  
        return $data;        
    }

    public function checkLoginHoursOutLive($user_id, $today)
    {
        $query = "SELECT * FROM loginhours 
                WHERE user_id = '$user_id' AND date = '$today'";
        $data = DB::connection('pgsql')->select($query);
                  
        return $data;        
    }
    
}
