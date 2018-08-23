<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salons extends Model
{
    protected $fillable = [
    	'agency', 'name', 'capacity', 'available', 'nextDateRent', 'preci', 'status'
    ];

    protected $connection;

    public function __construct()
    {
        $this->connection =  \Auth::user()->db;
    }

    public function scopeSalonsReservado($query)
    {
    	return $query->select('salons.*','reservation.date')
                     ->join('reservation','reservation.salon','=','salons.id')
                     ->get();
    }

    public function scopeSalonsAvailable($query)
    {
        return $query->where('status',0)
                     ->get();
    }
}
