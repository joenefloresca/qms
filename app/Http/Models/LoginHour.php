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

    public function checkLoginHours()
    {
        $query = "SELECT * FROM loginhours 
                WHERE user_id = 2 AND date = '2015-07-21' 
                AND status = 0 
                AND TIMESTAMP < CAST((CAST(now() AS DATE) + INTEGER '1') as TIMESTAMP) + INTERVAL '6 hours'";
        $data = DB::connection('pgsql')->select($query);
                  
        return $data;        
    }

    public function checkLoginHoursOut()
    {
        $query = "SELECT * FROM loginhours 
                WHERE user_id = 2 AND date = '2015-07-21' 
                AND status = 1 
                AND TIMESTAMP < CAST((CAST(now() AS DATE) + INTEGER '1') as TIMESTAMP) + INTERVAL '6 hours'";
        $data = DB::connection('pgsql')->select($query);
                  
        return $data;        
    }
    
}
