<?php

namespace App\Http\Models;
use DB;

class Customer extends \Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */

    /* Default for Eloquent */
    protected $table = 'customers';
    protected $connection = 'pgsql';
}
