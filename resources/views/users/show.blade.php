@extends('layouts.default')
@section('title', '注册')

@section('content')
	<br><br><br><br><br><br><br><br><br>
	<table>
		
		<tr>
			<th>名字</th>
			<th>邮箱</th>
			<th>密码</th>
		</tr>
		@foreach($user as $users)
		<tr>
			
			<td>{{$users->name}}</td>
			<td>{{$users->email}}</td>
			<td>{{$users->password}}</td>
			
		</tr><br>
		@endforeach
	</table>

@stop