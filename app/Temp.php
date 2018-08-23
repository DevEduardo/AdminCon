<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temp extends Model
{	
	protected $table = 'temp';
    protected $fillable = ['property', 'quantity', 'concept', 'total'];

    public function scopeProperty($query, $property)
    {
    	return $query->where('property',$property)->get();
    }
}
