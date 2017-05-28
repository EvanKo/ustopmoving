<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;  
use Illuminate\Database\Eloquent\Model;

class Client extends Authenticatable
{

    protected $fillable = [
        'name', 'password', 'token',
    ];

    protected $hidden = [
        'password', 
    ];
}

