<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>Profile</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
 <section class="py-5">
  <div class="container">
   <div class="card shadow mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
     <h3 class="mb-3 text-center">Profile</h3>
     <a href="{{ route("posts.index") }}" class="btn btn-primary">All Posts</a>
    </div>
    <div class="card-body">
     @session('success')
     <div class="alert alert-success">{{ session("success") }}</div>
     @endsession
     @session('error')
     <div class="alert alert-danger">{{ session("error") }}</div>
     @endsession
     <p><b>Name: </b>{{ auth()->user()->name }}</p>
     <p><b>Email: </b>{{ auth()->user()->email }}</p>
     <form action="{{ route("logout") }}" method="post">
      @csrf
      <button type="submit" class="btn btn-danger">Logout</button>
     </form>
    </div>
   </div>

   <div class="card shadow">
    <div class="card-header">
     <h3>My Posts</h3>
    </div>
    <div class="card-body">
     <table class="table table-striped table-bordered">
         <thead>
             <tr class="table-dark">
                 <th>#</th>
                 <th>Title</th>
                 <th>Created at</th>
                 <th>Action</th>
             </tr>
         </thead>
         <tbody>
             @forelse ($posts as $post)
                 <tr>
                     <td>{{ $post->id }}</td>
                     <td>{{ $post->title}}</td>
                     <td>{{ $post->created_at->diffForHumans()}}</td>
                     <td class="d-flex gap-1">
                         <a href="{{ route("posts.show", $post) }}" class="btn btn-primary">View</a>
                         <a href="{{ route("posts.edit", $post) }}" class="btn btn-success">Edit</a>
                         <form action="{{ route("posts.destroy", $post) }}" method="post">
                             @csrf
                             @method('DELETE')
                             <button type="submit" class="btn btn-danger">Delete</button>
                         </form>
                     </td>
                 </tr>
             @empty
                 
             @endforelse
         </tbody>
     </table>
    </div>
   </div>
  </div>
 </section>
</body>
</html>