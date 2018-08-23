<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $fillable = [
    	'estate', 'date', 'reference', 'concept', 'wayToPay', 'operationNumber', 'checkNumber', 'cardNumber', 'issuingBank', 'amount', 'status'
    ];

    protected $connection;

    public function __construct()
    {
        $this->connection =  \Auth::user()->db;
    }

    public function scopeProperty($query, $id)
    {
    	return $query->where('estate',$id)
    				 ->orderBy('id', 'DESC')
    				 ->get();
    }

    public function scopeApproved($query, $condominium)
    {
    	return $query->select('payments.*')
    				 ->join('estate','estate.id','=','payments.estate')
    				 ->where('estate.condominium',$condominium)
    				 ->where('payments.status',0)
    				 ->get();
    }
}
