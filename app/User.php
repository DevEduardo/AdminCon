<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','rol'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeTypeUser($query, $email)
    {
        return $query->select('agencies.id')
                     ->join('agencies','agencies.email','=','users.email')
                     ->where('users.email',$email)
                     ->first();
    }

    public function scopeEmployeeUserAgency($query, $email)
    {
        return $query->select('employees.agency')
                     ->join('employees','employees.email','=','users.email')
                     ->where('users.email',$email)
                     ->first();
    }

    public function scopeEmployeeId($query, $email)
    {
        return $query->select('employees.id')
                     ->join('employees','employees.email','=','users.email')
                     ->where('users.email',$email)
                     ->first();
    }

    public function scopeResidentId($query, $email)
    {
        return $query->select('estate.id')
                     ->join('estate','estate.email','=','users.email')
                     ->where('users.email',$email)
                     ->first();
    }

    public function scopeResident($query, $email)
    {
        return $query->select('estate.*')
                     ->join('estate','estate.email','=','users.email')
                     ->where('users.email',$email)
                     ->first();
    }

    public function scopeGetEmail($query, $email)
    {
        return $query->select('id','email')->where('email', $email)->first();
    }
}
