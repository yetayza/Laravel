@extends('layouts/app')
@section('content')
	<div class="container">
		@if(session('info'))

		<div class="alert alert-info">
			{{session('info')}}
		</div>

		@endif
		@foreach($data as $post)
			<div class="panel panel-default">
				<div class="panel-heading">
					<a href="{{url("/posts/view/$post->id")}}">
						{{$post->title}}</a>
				</div>
				<div class="panel-body">
					{{$post->body}}
				</div>
				<div class="panel-footer">
					by <i>{{$post->user->name}}</i>&nbsp;
					<b>{{$post ->category->name}}</b>,
					{{$post->created_at->diffForHumans()}}
					Comments({{count($post->comments)}})
				</div>
			</div>
		@endforeach
		{{$data->links()}}
	</div>
@endsection