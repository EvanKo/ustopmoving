<?php

namespace App\Api\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\sp_post;
use App\pt_post;
use App\sp_demand;
use JWTAuth;


class ActionsController extends BaseController
{
    /***
    *存储发布的赞助需求
    */
    public function store_command(Request $request)
    {
        $error = array();
        //学校，地区，赞助类型，赞助时间，本人称呼，内容用required

        if(!$request->get('wechat') && !$request->get('phone') && !$request->get('email') && !$request->get('qq')) {
            array_push($error, '至少填一项联系方式哟');
            return response()->json(compact('error'));
        }

        $user = JWTAuth::parseToken()->authenticate();

        $newPost = [
            'school' => $request -> get('school'),
            'area' => $request -> get('area'),
            'type' => $request -> get('type'),
            'time' => $request -> get('time'),
            'name' => $request -> get('name'),
            'wechat' => $request -> get('wechat'),
            'phone' => $request -> get('phone'),
            'email' => $request -> get('email'),
            'qq' => $request -> get('qq'),
            'content' => $request -> get('content'),

            //当前用户名
            'userName' => $user['name']
        ];

        sp_demand::create($newPost);
    }

    /***
    *存储发布的赞助信息
    */
    public function sp_post(Request $request)
    {
        $error = array();
        //赞助类型，赞助时间，本人称呼，内容用required
        if(!$request->get('wechat') && !$request->get('phone') && !$request->get('email') && !$request->get('qq')) {
            array_push($error, '至少填一项联系方式哟');
            return response()->json(compact('error'));
        }

        $user = JWTAuth::parseToken()->authenticate();

        $newPost = [
            'school' => $request -> get('school'),
            'area' => $request -> get('area'),
            'type' => $request -> get('type'),
            'time' => $request -> get('time'),
            'name' => $request -> get('name'),
            'wechat' => $request -> get('wechat'),
            'phone' => $request -> get('phone'),
            'email' => $request -> get('email'),
            'qq' => $request -> get('qq'),
            'content' => $request -> get('content'),

            //当前用户名
            'userName' => $user['name']
        ];

        sp_post::create($newPost);
    }

    /***
    *存储发布的兼职信息
    */
    public function pt_post(Request $request)
    {
        //判断错误类型
        $error = array();
        if (!$request -> get('type')) {
            $error = array ('赞助类型不能为空');
        }
        else if (!$request -> get('name')) {
            array_push($error, '本人称呼不能为空');
        }
        else if(!$request->get('wechat') && !$request->get('phone') && !$request->get('email') && !$request->get('qq')) {
            array_push($error, '至少填一项联系方式哟');
        }
        else if($error) {
            return response()->json(compact('error'));
        }
        $user = JWTAuth::parseToken()->authenticate();

        $newPost = [
            'area' => $request -> get('area'),
            'type' => $request -> get('type'),
            'time' => $request -> get('time'),
            'name' => $request -> get('name'),
            'wechat' => $request -> get('wechat'),
            'phone' => $request -> get('phone'),
            'email' => $request -> get('email'),
            'qq' => $request -> get('qq'),
            'content' => $request -> get('content'),

            //当前用户的用户名
            'userName' => $user['name']
        ];

        pt_post::create($newPost);
    }


}