@extends('layouts.default')
@section('title','home')
@section('content')

	<div class="jumbotron">
		<h1>hello laravel</h1>
		<p>
			你现在所看到的是 	<a href="https://fsdhub.com/books/laravel-essential-training-5.1">laravel</a>	
		</p>
		<p>一切。将从这里开始</p>
		 <p>
      <a class="btn btn-lg btn-success" href="#" role="button">现在注册</a>
      <a class="btn btn-lg btn-success" href="{{route('help')}}" role="button">帮助</a>
        
    </p>

    <a href="/help">路由跳转</a>
    <a href="{{ route('help')}}">路由跳转</a>
	</div>

@stop