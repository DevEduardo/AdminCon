<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agencies extends Model
{
    protected $fillable = [
    	'name','personContact','email','rif','address','phone','logo'
    ];
}
