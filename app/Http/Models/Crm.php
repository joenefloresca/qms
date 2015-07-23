<?php

namespace App\Http\Models;
use DB;

class Crm extends \Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */

    /* Default for Eloquent */
    protected $table = 'forms';
    protected $connection = 'pgsql';

    public function getCrmList()
    {
    	$query = "SELECT a.id as crmid, b.name, a.title, a.firstname, a.surname, a.disposition, a.gross, a.created_at FROM forms a INNER JOIN users b ON a.agent_id = b.id;";
    	$data = DB::connection('pgsql')->select($query);
		return $data;
    }
}
