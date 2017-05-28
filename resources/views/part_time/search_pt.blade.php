@extends('model')
@section('css')
    <style type="text/css">
        #main{
                margin-top: 230px;
                margin-right: auto;
                margin-left: auto;
                height: 250px;
                width: 800px;
                border: thin black solid;
                text-align: center;
                line-height: 150px;
                border-radius: 20px;
            }
        a:link{
            text-decoration: none;
            color: blue;
        }
        a:visited{
            color: blue;
        }
    </style>
@endsection

@section('body')
<!--*****************导航栏*******************-->
<a href="{{ url('/') }}">logo图片(回到首页)</a> |
<a href="{{ url('/spon') }}">找赞助</a> |
<a href="{{ url('/part_time') }}">找兼职</a> |
<a href="{{ url('/sp/command') }}">发布赞助需求</a> |
<a href="{{ url('/sp/post') }}">发布赞助信息</a> | 
<a href="{{ url('/pt/post') }}">发布兼职信息</a> |
<a href="{{ url('/sp/community') }}">赞助交流社区</a> |
<a href="{{ url('/pt/community') }}">兼职交流社区</a> |
<a href="{{ url('/feedback') }}">意见反馈</a>
<!--*****************导航栏*******************-->


<!--*****************中间搜索栏*******************-->
<div id="main">
    {!! Form::open(['url' => '/part_time', 'method' => 'post']) !!}

        <a href="{{ url('/') }}">搜赞助</a>
        搜兼职
            <select name="options">
                <option value="school">学校搜索</option>
                <option value="area">地区搜索</option>
            </select>
            <br>
        {!! Form::text('search_info') !!}
        {!! Form::submit('搜索') !!}
    {!! Form::close() !!}
<!--*****************中间搜索栏*******************-->

</div>
@endsection
