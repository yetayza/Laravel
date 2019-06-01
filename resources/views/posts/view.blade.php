@extends('layouts/app')
@section('content')
	<div class="container">
		@if(session('info'))
		<div class="alert alert-warning">
			{{session('info')}}
		</div>
		@endif
			<div class="panel panel-default">
				<div class="panel-heading">
					<a href="{{url("/posts/view/$post->id")}}">
						{{$post->title}}</a>
				</div>
				<div class="panel-body">
					<a href="#">{{$post->body}}</a>
				</div>
				<div class="panel-footer">
					by <i>{{$post->user->name}}</i>&nbsp;
					{{$post->created_at}}
					<div class="pull-right">
						<a href="{{url("posts/edit/$post->id")}}">Edit</a>
						<a href="{{url("posts/delete/$post->id")}}">Delete</a>
					</div>
				</div>
			</div>
			<h4>Comments({{count($post->comments)}})</h4>
			@foreach($post->comments as $comment)
				<div class="panel panel-default">
					<div class="panel-body">
						{{$comment->comment}}
					</div>
				</div>
			@endforeach

			<form action="{{url('/comment')}}" method="post">
				{{csrf_field()}}
				<input type="hidden" name="post_id" value="{{$post->id}}">
				<textarea name="comment" class="form-control">New Comment</textarea>
				<br>
				<input type="submit" value="Add Comment">
			</form>
	</div>
@endsection