<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class QuerysController extends Controller
{	

    static function all($table)
    {
    	$query = DB::connection(Auth()->user()->db)->select('SELECT * FROM '.$table);
    	if ($query == null) {
    		$data = [];
    		return $data;
    	}else{
    		return $query;
    	}
    }

    static function find($table, $id)
    {
    	DB::connection(Auth()->user()->db)->select('SELECT * FROM '.$table.' WHERE id = ?',$id);
    }
}
