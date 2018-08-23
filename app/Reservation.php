<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservation';

    protected $fillable = ['proerty','salon', 'date'];

    protected $connection;

    public function __construct()
    {
        $this->connection =  \Auth::user()->db;
    }

    public function scopeProperty($query, $id)
    {
    	return $query->where('property', $id)->get();
    }

/*SELECT salons.id, salons.name, reservation.property, reservation.date
FROM `reservation`
JOIN salons ON reservation.salon = salons.id*/

	public function scopeReserveAgency($query)
	{
		
	}
}
