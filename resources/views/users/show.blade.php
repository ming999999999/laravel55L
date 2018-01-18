@extends('layouts.default')
@section('title', '$user->name')

@section('content')
	<br><br><br><br><br><br><br><br><br>
	<div class="row">
	  <div class="col-md-offset-2 col-md-8">
	    <div class="col-md-12"><br><br>
	        <section class="user_info">
	          @include('shared._user_info', ['user' => $user])
	        </section>
	        <section class="stats">
	          @include('shared._stats',['user'=>Auth::User()])
	        </section>
	      </div>
	    </div><br><br>
	    <div class="col-md-12">
	    	<br><br>
	    	@if(Auth::check())
	    		@include('users._follow_form')
	    	@endif
	    	<br><br>
	      @if (count($statuses) > 0)
	        <ol class="statuses">
	          @foreach ($statuses as $status)
	            @include('statuses._status')
	          @endforeach
	        </ol>
	        {!! $statuses->render() !!}
	      @endif
	    </div>
	  </div>
	</div>

@stop