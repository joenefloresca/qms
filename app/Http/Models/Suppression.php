<?php

namespace App\Http\Models;

class Suppression extends \Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */

    /* Default for Eloquent */
    protected $table = 'suppressions';
    protected $connection = 'pgsql';
}
