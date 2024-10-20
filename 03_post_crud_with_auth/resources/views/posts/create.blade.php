@extends('layouts.app')

@section('title')
    Create a new post
@endsection
   

@section('content')
 <div class="card-header d-flex align-items-center justify-content-between">
  <h3 class="mb-3 text-center">Create a new post</h3>
  <a href="{{ route("posts.index") }}" class="btn btn-primary">All Posts</a>
 </div>
 <div class="card-body">
  <form action="{{ route("posts.store") }}" method="post">
    @csrf
    <div class="form-group mb-3">
        <label for="title">Post Title</label>
        <input type="text" name="title" id="title" value="{{ old("title") }}" autofocus class="form-control">
        @error('title')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group mb-3">
        <label for="content">Post Content</label>
        <textarea rows="5" name="content" id="content" class="form-control">{{ old("content") }}</textarea>
        @error('content')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Save Changes</button>
  </form>
 </div>
@endsection