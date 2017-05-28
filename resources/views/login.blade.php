@extends('model')
@section('body')
    {!! Form::open(array ('url' => '/api/login', 'method' => 'post')) !!}
    <table>
        <tr>
            <td>用户名</td>
            <td>{!! Form::text('name', null, ['maxlength' => '15']) !!}</td>
        </tr>
        <tr>
            <td>密码</td>
            <td>{!! Form::password('password', null, ['maxlength' => '20']) !!}</td>
        </tr>
        <tr>
            <td>{!! Form::submit('登录') !!}</td>
        </tr>
    </table>

    {!! Form::close() !!}
@endsection
