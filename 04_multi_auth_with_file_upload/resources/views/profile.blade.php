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
     <div class="d-flex gap-1">
      <a href="{{ url("/user-route") }}" class="btn btn-info btn-sm text-white">User Page</a>
      <a href="{{ url("/teacher-route") }}" class="btn btn-info btn-sm text-white">Teacher Page</a>
     </div>
    </div>
    <div class="card-body">
     @session('success')
     <div class="alert alert-success">{{ session("success") }}</div>
     @endsession
     @session('error')
     <div class="alert alert-danger">{{ session("error") }}</div>
     @endsession
     <div class="row">
      <div class="col-md-4">
       @if (auth()->user()->image)
        <img src="{{ asset('storage/uploaded/users/'.auth()->user()->image) }}" alt="profile-image">
       @endif
      </div>
      <div class="col-md-8">
       <p><b>Name: </b>{{ auth()->user()->name }}</p>
       <p><b>Email: </b>{{ auth()->user()->email }}</p>
       <p><b>Role: </b>{{ auth()->user()->role }}</p>
       <form action="{{ route("logout") }}" method="post">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
       </form>
      </div>
     </div>
    </div>
   </div>
  </div>
 </section>
</body>
</html>