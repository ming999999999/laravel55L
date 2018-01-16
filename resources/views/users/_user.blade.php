<li>
	<img src="{{$users->gravatar()}}" alt="{{$users->name}}" class="gravatar" style="width:20px;height:20px;">
	<a href="{{route('users.show',$users->id)}}" class="username">{{$users->name}} </a><br>
	@can('destroy',$users)
		<form action="{{ route('users.show',$users->id) }}" method="post">
			{{csrf_field()}}
			{{method_field('DELETE')}}
			<button type="submit" class="btn btn-sm btn-danger delete-btn"> 删除 </button>
		</form>
	@endcan
</li>