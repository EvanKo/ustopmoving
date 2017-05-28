@extends('model')
@section('css')
    <style type="text/css">
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
发布赞助需求 |
<a href="{{ url('/sp/post') }}">发布赞助信息</a> |
<a href="{{ url('/pt/post') }}">发布兼职信息</a> |
<a href="{{ url('/sp_community') }}">赞助交流社区</a> |
<a href="{{ url('/pt_community') }}">兼职交流社区</a> |
<a href="{{ url('/feedback') }}">意见反馈</a>
<!--*****************导航栏*******************-->
    {!! Form::open(['url' => '/api/command', 'method' => 'post']) !!}
    <table cellspacing="10" cellpadding="4" width="700">
        <tr>
            <td width="10" height="20">学校：</td>
            <td>{!! Form::text('school', null, ['size' => '30', 'maxlength' => '15']) !!}</td>
            <td><font face="Courier New" size="2">（最大长度为15）</font></td>
        </tr>
        <tr>
            <td>学校所在地区：</td>
            <td>{!! Form::text('area', null, ['size' => '30', 'maxlength' => '10']) !!}</td>
            <td><font face="Courier New" size="2">（最大长度为10）</font></td>
        </tr>
        <tr>
            <td>赞助类型：</td>
            <td>{!! Form::text('type', null, ['placeholder' => '讲座，摊位等', 'size' => '30', 'maxlength' => '10']) !!}</td>
            <td><font face="Courier New" size="2">（最大长度为10）</font></td>
        </tr>
        <tr>
            <td>赞助时间：</td>
            <td>{!! Form::text('time', null, ['placeholder' => '自由格式', 'size' => '30', 'maxlength' => '15']) !!}</td>
            <td><font face="Courier New" size="2">（最大长度为15）</font></td>
        </tr>
        <tr>
            <td>本人称呼：</td>
            <td>{!! Form::text('name', null, ['size' => '30', 'maxlength' => '5'] )!!}</td>
            <td><font face="Courier New" size="2">（最大长度为5）</font></td>
        </tr>
        <tr>
            <td>联系方式</td>
            <td><font face="Courier New" size="2">（以下四种联系方式至少填一项）</font></td>
        </tr>
        <tr>
            <td>微信：</td>
            <td>{!! Form::text('wechat', null, ['placeholder' => '可选', 'size' => '30', 'maxlength' => '20']) !!}</td>
            <td><font face="Courier New" size="2">（最大长度为20）</font></td>
        </tr>
        <tr>
            <td>手机：</td>
            <td>{!! Form::text('phone', null, ['placeholder' => '可选', 'size' => '30', 'maxlength' => '11']) !!}</td>
            <td><font face="Courier New" size="2">（最大长度为11）</font></td>
        </tr>
        <tr>
            <td>邮箱：</td>
            <td>{!! Form::text('email', null, ['placeholder' => '可选', 'size' => '30', 'maxlength' => '30']) !!}</td>
            <td><font face="Courier New" size="2">（最大长度为30）</font></td>
        </tr>
        <tr>
            <td>qq：</td>
            <td>{!! Form::text('qq', null, ['placeholder' => '可选', 'size' => '30', 'maxlength' => '15']) !!}</td>
            <td><font face="Courier New" size="2">（最大长度为15）</font></td>
        </tr>                        
        <tr>
            <td>赞助内容：</td>
            <td>{!! Form::textarea('content', null, ['maxlength' => '200']) !!}</td>
            <td><font face="Courier New" size="2">（最大长度为200）</font></td>
        </tr>
        <tr>
            <td>{!! Form::submit('发布') !!}</td>
        </tr>
    </table>
    {!! Form::close() !!}
@endsection