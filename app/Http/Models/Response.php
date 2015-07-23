<?php

namespace App\Http\Models;
use DB;

class Response extends \Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */

    /* Default for Eloquent */
    protected $table = 'responses';
    protected $connection = 'pgsql';

    public function getResponsesByCrmId($crmid)
    {
    	$query = "SELECT a.id, a.question_id, b.columnheader, b.question, a.response FROM responses a INNER JOIN questions b ON a.question_id = b.id WHERE a.crm_id = '$crmid';";
    	$data = DB::connection('pgsql')->select($query);
		return $data;
    }
}
