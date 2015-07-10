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
}
