<?php

namespace App\Http\Models;
use DB;

class Question extends \Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */

    /* Default for Eloquent */
    protected $table = 'questions';
    protected $connection = 'mcssurvey_main';
    
}
