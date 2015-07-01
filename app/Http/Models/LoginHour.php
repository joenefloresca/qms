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
    
}
