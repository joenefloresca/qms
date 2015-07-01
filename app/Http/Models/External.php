<?php

namespace App\Http\Models;
use DB;

class External
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    

    public function createHeader($headerName, $connString, $method)
    {
    	switch($method)
    	{
    		case "ADD":
    			$query = "ALTER TABLE customer ADD $headerName character varying";
		    	$query2 = "ALTER TABLE customer_history ADD $headerName character varying";

		    	/* Returns empty if success.
				   We don't need to return anyting for now	
		    	*/
		    	$data = DB::connection($connString)->select($query);
		    	$data2 = DB::connection($connString)->select($query2);
		    break;
		    
		    case "DROP":
		    	$query = "ALTER TABLE customer DROP COLUMN $headerName";
		    	$query2 = "ALTER TABLE customer_history DROP COLUMN $headerName";

		    	/* Returns empty if success.
				   We don't need to return anyting for now	
		    	*/
		    	$data = DB::connection($connString)->select($query);
		    	$data2 = DB::connection($connString)->select($query2);
		    break;
		    
		    default:	

    	}
    	
		          
		return array('customer' => $data, 'customer_history' => $data2);
    }
    
}
