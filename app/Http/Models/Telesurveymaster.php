<?php

namespace App\Http\Models;

class Telesurveymaster extends \Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */

    /* Default for Eloquent */
    protected $table = 'TelesurveyMaster';
    protected $connection = 'sqlsrv';
}
