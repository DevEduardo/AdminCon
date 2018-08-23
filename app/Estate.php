<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estate extends Model
{
	protected $table = 'estate';

    protected $fillable = [
    	'condominium', 'numebreProperty', 'owner', 'phone', 'emial', 'aliquot', 'assistant', 'gas', 'water', 'light', 'area', 'debit', 'status' 
    ];

    protected $connection;

    public function __construct()
    {
        $this->connection =  \Auth::user()->db;
    }

    public function scopeGetEstateCondominium($query, $idCondominium)
    {
    	return $query->where('condominium',$idCondominium)
    				 ->get();
    }

    public function scopeGetEstateCondominiumActive($query, $idCondominium)
    {
        return $query->where('condominium',$idCondominium)
                     ->where('status',1)
                     ->get();
    }

    public function scopeEstateAgencyId($query, $property)
    {
        return $query->select('condominiums.agency')
                     ->join('condominiums', 'condominiums.id','=','estate.condominium')
                     ->where('estate.id',$property)
                     ->get();
    }

    public function scopeEmails($query, $des, $hast)
    {
        return $query->select('id','email','owner')
                 ->whereBetween('id', [$des, $hast])->get();
    }

    public function scopePropertyBetween($query, $des, $hast)
    {
        return $query->select('id','email','owner')
                 ->whereBetween('id', [$des, $hast])->get();
    }
}
