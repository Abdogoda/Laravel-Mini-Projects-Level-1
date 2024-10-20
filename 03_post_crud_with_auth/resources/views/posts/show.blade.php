@extends('layouts.app')

@section('title')
    Post Details
@endsection
   

@section('content')
 <div class="card-header d-flex align-items-center justify-content-between">
  <h3 class="mb-3 text-center">Post Details</h3>
  <a href="{{ route("posts.index") }}" class="btn btn-primary">All Posts</a>
 </div>
 <div class="card-body">
    <p><b>Title: </b>{{ $post->title }}</p>
    <p><b>Created at: </b>{{ $post->created_at->diffForHumans() }}</p>
    <p><b>Created by: </b>{{ $post->user->name }}</p>
    <p>{{ $post->content }}</p>
 </div>
@endsection