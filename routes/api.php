<?php

use App\Client;
use App\sp_post;
use App\pt_post;
use App\sp_demand;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('jwt.api.auth');

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Api\Controllers'], function($api) {
        /***
        * 全部内容
        */
        $api->get('/sp_all', function() {
            $info = App\sp_post::paginate(2);
            return response()->json(compact('all'));        //小程序不分页
            //return $info->withPath('url');        //网页分页
        });
        $api->get('/pt_all', function() {
            $all = pt_post::all();
            return response()->json(compact('all'));        //小程序不分页
            //return $all->withPath('url');       //网页分页
        });

        /***
        * 搜索赞助信息
        */
        $api->post('/sp_search', function(Request $request) {
                $text = $request->get('text');
                $option = $request -> get('option');

                $single = array();
                for ($i = 0; $i <= mb_strlen($text); $i++)
                {
                    array_push($single, mb_substr($text, $i, 1, 'utf-8'));
                }

                //生成搜索字符串
                $str = '%'.implode('%', $single);

                if ($option == 'school')
                    $info = sp_post::where('school', 'like', $str)->paginate(5);
                else if ($option == 'area')
                    $info = sp_post::where('area', 'like', $str)->paginate(5);
                else if ($option == 'type')
                    $info = sp_post::where('type', 'like', $str)->paginate(5);

                return response()->json(compact('info'));   //小程序不需要分页
                //$info->withPath('url');     //网页分页
            });

        /***
        * 搜索兼职信息
        */
        $api->post('/pt_search', function(Request $request) {
                $text = $request->get('text');
                $option = $request -> get('option');

                $single = array();
                for ($i = 0; $i <= mb_strlen($text); $i++)
                {
                    array_push($single, mb_substr($text, $i, 1, 'utf-8'));
                }

                //生成搜索字符串
                $str = '%'.implode('%', $single);

                if ($option == 'area')
                    $info = sp_post::where('area', 'like', $str)->paginate(5);
                else if ($option == 'type')
                    $info = sp_post::where('type', 'like', $str)->paginate(5);

                return response()->json(compact('info'));       //小程序不分页
                //$info->withPath('url');     网页分页
            });


        //用户行为
        $api->post('/register', 'AuthControllers@register');
        $api->post('/login', 'AuthControllers@login');
        //$api->get('/test', 'AuthControllers@test');

        //需通过登陆后的行为
        $api->group(['middleware' => 'jwt.api.auth'], function($api) {
            /***
            * 个人中心行为
            ***/

            //返回用户个人信息还有用户发布过的信息
            $api->get('/me', 'AuthControllers@UserInfo');  
            //删除赞助发布
            $api->delete('/sp_delete/{id}', 'AuthControllers@sp_delete');      
            //删除兼职发布
            $api->delete('/pt_delete/{id}', 'AuthControllers@pt_delete');       
            //删除赞助需求
            $api->delete('/demand_delete/{id}', 'AuthControllers@demand_delete'); 

            //注销
            $api->get('/logout', 'AuthControllers@logout');     

            /***
            * 发布行为
            */
            $api->post('/command', 'ActionsController@store_command');
            $api->post('/sp_post', 'ActionsController@sp_post');
            $api->post('/pt_post', 'ActionsController@pt_post');
        });
    });
});
