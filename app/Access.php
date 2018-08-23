<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    protected $fillable = [
    	'employee', 'records', 'moves', 'emails', 'informe'
    ];

    public function scopeEmployee($query, $employee)
    {
    	return $query->where('employee', $employee)->get();
    }
}
