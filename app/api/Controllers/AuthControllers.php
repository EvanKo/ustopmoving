<?php

namespace App\Api\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\pt_post;
use App\sp_post;
use App\sp_demand;
use JWTAuth;
use JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class AuthControllers extends BaseController
{
    /**
     * The authentication guard that should be used.
     *
     * @var string
     */
    public function __construct()
    {
        parent::__construct();
    }

    /*public function test()
    {
        header('token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEwLCJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTQ5NTcxMzkxNywiZXhwIjoxNDk1NzE3NTE3LCJuYmYiOjE0OTU3MTM5MTcsImp0aSI6Imx4bGJOcTJuM1MydW5Mdm0ifQ.lFZUmpY_fj491GVkOUaArCDEwmptCertcdCtKpN8Yss');
        print_r(getallheaders());
        return;
        JWTAuth::parseToken();
        //$arr = array ('STATUS'=>'ERROR ID');
        //return response()->json(compact('arr'));
    }*/

    public function register(Request $request)  
    {  
        $name = $request->get('name');
        $password1 = $request->get('password1');
        $password2 = $request->get('password2');

        /************************************
        *设置一下表单最大长度，用户名为15，密码为20
        ************************************/
        if (Client::where('name', $name)->first())
        {
            $arr = array ('error' => '用户已存在');
            return response()->json(compact('arr'));
        }

        /************************************
        *设置一下表单最大长度，用户名为15，密码为20
        ************************************/

        //验证用户是否存在以及密码输入
        else if (strlen($password1) < 8)
        {
            $arr = array ('error' => '密码长度大于8个字符哟');
            return response()->json(compact('arr'));
        }
        else if ($password1 != $password2)
        {
            $arr = array ('error' => '两次密码输入不一致');
            return response()->json(compact('arr'));
        }

        $newUser = [  
            'name' => $request->get('name'),  
            'password' => $request->get('password1')  
        ];  
        $user = Client::create($newUser);  
        $token = JWTAuth::fromUser($user);
        return $token;  
    }  


    /**
    *注册通过后创建token
    */
    /*public function register(Request $request)
    {
        $name = $request->get('name');
        //数据库中有已注册用户
        if(User::where('name', $name))
        {
            $arr = array ('error' => '用户名已存在');
            return response()->json(compact('arr'));
        }
        else
        {
            $newUser = [
                'name' => $name,
                'password' => bcrypt($request->get('password')),
                'exp' => time() + 60*60*24
            ]
            $user = Client::create($newUser);
            $user['now'] = time();      //用于token创建

            $token = JWTAuth::fromUser($user);

            //将token放入数据库
            Client::where('name', $request->get('name'))->update(array ('rememberToken' => $token));

            //拿用户昵称和token，跳转已登录状态
            return response()->json(compact('user', 'token'));
        }
    }
    */

    /***
    *登录时候创建token
    **/
    public function login(Request $request)
    {
        //先检查用户是否存在
        $checkUser = Client::where('name', $request->get('name'));
        if (!$checkUser)
        {
            $error = array ('error' => '这个用户还不存在');
            return response()->json(compact('error'));
        }

        //return $request->get('password');
        $user = Client::where([
                'name' => $request->get('name'), 
                'password' => $request->get('password')
            ])->first();

        //检查密码是否正确
        if (!$user)
        {
            $error = array ('error' => '密码错辣!');
            return response()->json(compact('error'));
        }


        //加入token的创建
        $user['now'] = time();

        $token = JWTAuth::fromUser($user);
        return response()->json(compact('token', 'user'));

        /*
        $payload = [
            'name' => $request->get('name'),
            'password' => $request->get('password'),
        ];
        //return $payload;

        try {
            if (!$token = JWTAuth::attempt($payload)) {
                return response()->json(['error' => 'token_not_provided'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => '不能创建token'], 500);
        }
        
        
        $user = Client::where('name', $request->get('name'))->get();
        $user['now'] = time();      //加入token创建
        

        //根据用户信息和现在时间生成token
        $token = JWTAuth::fromUser($user);

        //将token放入数据库
        Client::where('name', $request->get('name'))->update(array ('token' => $token));

        //返回token和用户信息
        return response()->json(compact('token', 'user'));
        */
    }

    /****
    * 注销刷新token
    */
    public function logout()
    {
        JWTAuth::refresh();
        $arr = array ('message' => '注销成功');
        return response()->json(compact('arr'));
    }

    /****
     * 根据token获取用户的信息并返回用户发布过的赞助和兼职信息
     * @return \Illuminate\Http\JsonResponse
     */
    public function UserInfo()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        // the token is valid and we have found the user via the sub claim


        //获取用户发布过的兼职和赞助信息 
        $pt_posts = pt_post::where('userName', $user['name'])->get();
        $sp_posts = sp_post::where('username', $user['name'])->get();        

        return response()->json(compact('user', 'pt_posts', 'sp_posts'));
    }


    /***
    *删除个人发布的赞助信息
    */
    public function sp_delete($id)
    {
        sp_post::find($id)->delete();
    }


    /***
    *删除个人发布的兼职信息
    */
    public function pt_delete($id)
    {
        pt_post::find($id)->delete();
    }


    /***
    *删除个人发布的赞助需求
    */
    public function demand_delete($id)
    {
        sp_demand::find($id)->delete();
    }
}
