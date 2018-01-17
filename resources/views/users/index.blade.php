@extends('layouts.default')

@section('title','所有用户')
@section('content')
	<br><br><br><br><br><br><br>
	@include('shared._status_from')
	<div class="col-md-offset-2 col-md-8">
		<h1>所有用户</h1>
		<ul class="users">
			@foreach($user as $users)
				@include('users._user')
			@endforeach
		</ul>
		{!! $user->render() !!}
	</div>
@stop