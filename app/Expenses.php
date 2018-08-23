<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    protected $fillable = [
    	'condominium', 'account', 'reference', 'description', 'amount', 'share', 'calculation', 'status'
    ];

    protected $connection;

    public function __construct()
    {
        $this->connection =  \Auth::user()->db;
    }

    public function scopeMonthCondominium($query, $month, $condominium)
    {
      return $query->whereMonth('created_at', $month)
                   ->where('condominium', $condominium)
                   ->orderBy('share')
                   ->get();
    }

    /***
    * 0 => No comun
    * 1 => Extra
    * 2 => Comun
    ***/

    public function scopeShare($query, $share, $condominium, $month)
    {
    	return $query->where('share',$share)
    				 ->where('condominium',$condominium)
    				 ->whereMonth('created_at',$month)
    				 ->get();
    }

    public function scopeWithCalculations($query, $month, $condominium)
    {
        return $query->whereMonth('created_at', $month)
                   ->where('condominium', $condominium)
                   ->where('status', 1)
                   ->get();
    }
}
