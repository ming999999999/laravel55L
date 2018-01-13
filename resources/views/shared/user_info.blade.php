<a href="{{route('share',$user->id)}}">
	
	<img src="{{$user->gravatar('600')}}" alt="{{$user->name}}">
</a>

<h1>{{$user->name}}</h1>