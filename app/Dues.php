<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Dues extends Model
{
    protected $fillable = [
    	'property', 'month', 'type', 'number', 'amount', 'status'
    ];

    protected $connection;

    public function __construct()
    {
        $this->connection =  \Auth::user()->db;
    }

    public function scopeYear($query, $year)
    {
        return $query->whereYear('created_at',$year)
                     ->where('status',0)
                     ->get();
    }

    public function scopeProperty($query, $property)
    {
    	return $query->where('property',$property)
    				 ->where('status',0)
    				 ->get();
    }

    public function scopePropertyMora($query, $condominiun)
    {
        return $query->select('estate.id','estate.numebreProperty', 'estate.condominium', 'estate.owner', 'dues.amount')
                     ->join('estate','estate.id','=','dues.property')
                     ->where('dues.status',0)
                     ->where('estate.condominium',$condominiun)
                     ->get();
    }

    public function scopeEstateDebit($query)
    {
    	return $query->groupBY('property')
    	   			 ->sum('amount');
    }

    public function scopeAccountsReceivable($query, $condominium)
    {
       return $query->select('estate.condominium',  'estate.id', 'estate.owner', 'dues.month', 'dues.number', 'dues.amount', 'dues.status')
                    ->join('estate','estate.id','=','dues.property')
                    ->where('estate.condominium',$condominium)
                    ->where('dues.status',0)
                    ->get();
    }

    public function scopeShareMonthProperty($query, $month)
    {
      return $query->select('estate.owner','estate.numebreProperty','dues.amount')
                   ->join('estate','estate.id','=','dues.property')
                   ->whereMonth('dues.created_at', $month)
                   ->get();
    }

    public function scopeCalculatedFee($query, $month)
    {
        return $query->where('status',0)
                     ->whereMonth('created_at', $month)
                     ->get();
    }

    public function scopeSumYearLast($query, $year)
    {
      return $query->select('property','created_at',  \DB::raw('SUM(amount) as deuda'))
                   ->whereYear('created_at', '<', $year)
                   ->get();
    }

    public function scopeSumTotal($query)
    {
      return $query->select('property',  \DB::raw('SUM(amount) as total'))
                   ->where('status',0)
                   ->groupBy('property')
                   ->get();
    }

}
