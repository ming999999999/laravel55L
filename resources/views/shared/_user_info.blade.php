<a href="{{route('share',$user->id)}}">
	
	<img src="{{$user->gravatar('600')}}" alt="{{$user->name}}" style="width:50px;height:50px">
</a>

<h1>{{$user->name}}</h1>