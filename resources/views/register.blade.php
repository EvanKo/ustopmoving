@extends('model')
@section('body')
    {!! Form::open(array ('url' => '/api/register', 'method' => 'post')) !!}
    <table>
        <tr>
            <td>用户名</td>
            <td>{!! Form::text('name', null, ['maxlength' => '15']) !!}</td>
        </tr>
        <tr>
            <td>密码</td>
            <td>{!! Form::password('password1', null, ['maxlength' => '20']) !!}</td>
        </tr>
        <tr>
            <td>确认密码</td>
        <td>{!! Form::password('password2', null, ['maxlength' => '20']) !!}</td>
        </tr>
        <tr>
            <td>{!! Form::submit('注册') !!}</td>
        </tr>
    </table>
    {!! Form::close() !!}
@endsection