<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sp_demand extends Model
{
    protected $fillable = [
        'school', 'area', 'type', 'time', 'content', 'name', 'wechat', 'phone', 'email', 'qq', 'userName'
    ]
}
