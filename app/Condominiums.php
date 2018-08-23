<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Condominiums extends Model
{
	protected $connection;

	public function __construct()
	{
		$this->connection =  \Auth::user()->db;
	}

    protected $fillable= [
    	'agency', 'name', 'document', 'address', 'phone', 'email', 'message', 'calculation','amount', 'logo', 'personContact'    
    ];
    

}
