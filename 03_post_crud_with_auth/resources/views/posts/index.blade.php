@extends('layouts.app')

@section('title')
    All Posts
@endsection
   

@section('content')
 <div class="card-header d-flex align-items-center justify-content-between">
  <h3 class="mb-3 text-center">All Posts</h3>
  @auth
  <a href="{{ route("posts.create") }}" class="btn btn-primary">Create a new post</a>
  @endauth
 </div>
 <div class="card-body">
    <table class="table table-striped table-bordered">
        <thead>
            <tr class="table-dark">
                <th>#</th>
                <th>Title</th>
                <th>Created at</th>
                <th>Created by</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title}}</td>
                    <td>{{ $post->created_at->diffForHumans()}}</td>
                    <td>{{ $post->user->name }}</td>
                    <td class="d-flex gap-1">
                        <a href="{{ route("posts.show", $post) }}" class="btn btn-primary">View</a>
                        @auth
                            @if ($post->user_id == auth()->user()->id)
                                <a href="{{ route("posts.edit", $post) }}" class="btn btn-success">Edit</a>
                                <form action="{{ route("posts.destroy", $post) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @endif
                        @endauth
                    </td>
                </tr>
            @empty
                
            @endforelse
        </tbody>
    </table>
 </div>
@endsection