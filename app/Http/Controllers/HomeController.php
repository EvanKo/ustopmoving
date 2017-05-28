<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\spon_post;
use App\pt_post;
use App\User;
use App\Client;

class HomeController extends Controller
{
    /*********
    搜索赞助首页
    *********/
    public function index()
    {

    }

    
    public function test()
    {
        print_r(getallheaders());
    }
    


    /*********
    搜索兼职首页
    *********/
    public function search()
    {
        $arr = array ('STATUS'=>'ERROR ID');
        return response()-json(compact('arr'));
    }



    /****************************
    所有赞助信息 and 搜索赞助后的结果
    ****************************/
    public function show_spon(Request $request)
    {
        //在主页搜索时处理搜索信息返回搜索结果
        if(!is_null($request->get('search_info')))
        {
            $text = $request->get('search_info');
            if(isset($_GET['type']))
                {$type = $_GET['type'];}
            else
                {$type = $request -> get('type');}

            $single = array();
            for($i = o; $i <= mb_strlen($text); $i++)
            {
                array_push($single, mb_substr($text, $i, 1, 'utf-8'));
            }
            if(isset($_GET['str']))
                {$str = $_GET['str'];}
            else
                {$str = '%'.implode('%', $single);}

            //创建一下spon_post的model
            if($type = 'school')
                $info = sp_post::where('school', 'like', $str)->paginate(5);
            else if($type = 'area')
                $info = sp_post::where('area', 'like', $str)->paginate(5);
            else
                $info = sp_post::where('type', 'like', $str)->paginate(5);

            return view('spon.show_sp', compact('type', 'info', 'str'));
        }

        //没有搜索的时候显示全部信息
        else
        {
            //$info = sp_post::paginate(5);
            return view('spon.show_sp', compact('info'));
        }
    }



   /****************************
    所有兼职信息 and 搜索兼职后的结果
    ****************************/
    public function show_pt(Request $request)
    {
        //在主页搜索，处理搜索信息，返回搜索结果
        if(!is_null($request->get('search_info')))
        {
            $text = $request->get('search_info');
            if(isset($_GET['type']))
                {$type = $_GET['type'];}
            else
                {$type = $request -> get('type');}

            $single = array();
            for($i = o; $i <= mb_strlen($text); $i++)
            {
                array_push($single, mb_substr($text, $i, 1, 'utf-8'));
            }
            if(isset($_GET['str']))
                {$str = $_GET['str'];}
            else
                {$str = '%'.implode('%', $single);}

            //创建一下pt_post的model
            if($type = 'school')
                $info = pt_post::where('school', 'like', $str)->paginate(5);
            else if($type = 'area')
                $info = pt_post::where('area', 'like', $str)->paginate(5);
            else
                $info = pt_post::where('type', 'like', $str)->paginate(5);

            return view('part_time.show_pt', compact('type', 'info', 'str'));
        }

        //没有搜索，返回所有兼职信息
        else
        {
            //$info = pt_post::paginate(5);
            return view('part_time.show_pt', compact('info'));
        }
    }



    /***
    意见反馈
    ***/
    public function feedback()
        {return view('feedback');}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->get('name');
        $password1 = $request->get('password1');
        $password2 = $request->get('password2');
        if($password1 != $password2)
        {
            $arr = array ('error' => '两次密码输入不一致');
            return response()->json(compact('arr'));
        }
        else
        {
            $newUser = array (
                    'name' => $name,
                    'password' => bcrypt($password1),
                );
            User::create($newUser);
            return User::all();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
