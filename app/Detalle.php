<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    protected $table = 'detalle';
    protected $fillable = ['invoice', 'quantity', 'concept', 'total'];

    protected $connection;

    public function __construct()
    {
        $this->connection =  \Auth::user()->db;
    }

}
