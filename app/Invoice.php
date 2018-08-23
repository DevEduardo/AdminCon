<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{	
	protected $table = 'invoice';
    protected $fillable = [
    	'number', 'businessName', 'document', 'phone', 'iva', 'total', 'wayToPay', 'operationNumber', 'issuingBank'
    ];

    protected $connection;

    public function __construct()
    {
        $this->connection =  \Auth::user()->db;
    }

    public function scopeInvoiceNumber($query, $number)
    {
    	return $query->where('number','like','%'.$number.'%')->first();
    }
}
