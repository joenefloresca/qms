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
}
