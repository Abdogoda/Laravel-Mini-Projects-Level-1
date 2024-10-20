<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>Edit a user</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
 <section class="py-5 mt-5">
  <div class="container">
   <div class="card shadow">
    <div class="card-header d-flex align-items-center justify-content-between">
        
     <h3>Edit a user</h3>
     <a href="{{route("users.index")}}" class="btn btn-primary">All users</a>
    </div>
    <div class="card-body">
     @session('success')
     <div class="alert alert-success">{{ session("success") }}</div>
     @endsession
     @session('error')
     <div class="alert alert-danger">{{ session("error") }}</div>
     @endsession
     <form action="{{route("users.update", $user)}}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="role">User role</label>
            <select name="role_id" id="role" class="form-control">
                @foreach ($roles as $role)
                    <option value="{{$role->id}}" {{$user->role_id == $role->id ? 'selected' : ''}}>{{$role->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Save Changes</button>
     </form>
    </div>
   </div>
  </div>
 </section>
</body>
</html>