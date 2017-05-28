<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sp_post extends Model
{
    protected $fillable = [
        'userName', 'type', 'area', 'content', 'name', 'wechat', 'phone', 'email', 'qq', 'school', 'time'
    ];
}
