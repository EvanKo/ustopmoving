<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pt_post extends Model
{
    protected $fillable = [
        'userName', 'type', 'area', 'content', 'name', 'wechat', 'phone', 'email', 'qq', 'time'
    ];
}
