<?php

namespace App\Http\Models;

class Mutual extends \Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */

    /* Default for Eloquent */
    protected $table = 'mutuals';
    protected $connection = 'pgsql';
}