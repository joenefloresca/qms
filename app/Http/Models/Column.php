<?php

namespace App\Http\Models;
use DB;

class Column extends \Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */

    /* Default for Eloquent */
    protected $table = 'columns';
    protected $connection = 'pgsql';

    public function deleteFromRecord($column, $method, $database)
    {
        $query = "DELETE FROM columns WHERE column_header = '$column' AND method = '$method' AND database = '$database' ";
        $data = DB::connection('pgsql')->delete($query);
        return $query;
    }
    
}
