<?php

namespace App\Http\Models;
use DB;

class QaCrm extends \Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */

    /* Default for Eloquent */
    protected $table = 'qa_forms';
    protected $connection = 'pgsql';

    public function getVerifiedAll()
    {
    	$query = "SELECT *,a.id as verfiedcrmid, b.name as agentname FROM qa_forms a INNER JOIN users b ON a.agent_id = b.id;";
    	$data = DB::connection('pgsql')->select($query);
    	return $data;
    }
}
