<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bills extends Model
{
    protected $fillable = [
    	'name', 'code', 'finance', 'estimate', 'value'
    ];

    protected $connection;

    public function __construct()
    {
        $this->connection =  \Auth::user()->db;
    }

    public function scopeNotFund($query)
    {
    	return $query->where('finance','=',3)->get();
    }

    public function scopeFund($query)
    {
    	return $query->whereBetween('finance', [1, 2])->get();
    }
}
