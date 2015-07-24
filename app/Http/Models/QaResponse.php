<?php

namespace App\Http\Models;
use DB;


class QaResponse extends \Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */

    /* Default for Eloquent */
    protected $table = 'qa_responses';
    protected $connection = 'pgsql';

    public function getResponsesByCrm($crmid)
    {
    	$query = "SELECT b.columnheader, a.response FROM responses a INNER JOIN questions b ON a.question_id = b.id WHERE a.crm_id = '$crmid';";
    	$data = DB::connection('pgsql')->select($query);
    	return $data;
    }

    public function getQaResponsesByCrmId($qacrmid)
    {
        $query = "SELECT a.id, a.question_id, b.columnheader, b.question, a.response FROM qa_responses a INNER JOIN questions b ON a.question_id = b.id WHERE a.qa_forms_id = '$qacrmid';";
        $data = DB::connection('pgsql')->select($query);
        return $data;
    }
}
