<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $fillable = [
    	'agency', 'name', 'email', 'phone'
    ];

    protected $connection;

    public function __construct()
    {
        $this->connection =  \Auth::user()->db;
    }

    public function scopeAgency($query, $agency)
    {
    	return $query->where('agency', $agency)->get();
    }
}
