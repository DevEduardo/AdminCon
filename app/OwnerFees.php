<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OwnerFees extends Model
{	
	protected $table = 'ownerFees';
    protected $fillable = [
    	'property', 'share', 'participation'
    ];

    protected $connection;

    public function __construct()
    {
        $this->connection =  \Auth::user()->db;
    }

    public function scopeCalculatedOwnerFees($query, $month)
    {
        return $query->whereMonth('created_at', $month)
                     ->get();
    }
}
